<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import gsap from 'gsap';


import { computed, reactive, ref, toRaw } from '@vue/reactivity';
import { onMounted, watch } from '@vue/runtime-core';
import axios from 'axios';

const loadedCartItems = ref([]);

const checkedItems = ref([])

const checkedAll = ref(false)

const totalAmount = ref(0)


onMounted(() => {
    var cartItems = [];
    if (localStorage.cart)
        cartItems = JSON.parse(localStorage.cart);
    else return;

    const product_ids = cartItems.map(c => c.id)

    axios.get(route('cart-with-product'), {
        params: {
            ids: product_ids
        },
    }).then((response) => {

        loadedCartItems.value = response.data;

        loadedCartItems.value.forEach((v) => {
            v.quantity = cartItems.find(x => x.id == v.id).quantity
        })

        console.log(loadedCartItems.value)
    }).catch((error) => {

    })
})

const saveCart = (cartItems) => {
    localStorage.cart = JSON.stringify(cartItems)
}

const validQuantity = (v) => {
    return v > 0;
}

const deleteCartItems = () => {
    checkedItems.value.forEach((e) => {
        loadedCartItems.value.splice(e, 1)
    })
    checkedItems.value = [];
}



watch(
    () => [_.cloneDeep(loadedCartItems.value), checkedAll.value, checkedItems.value],
    ([newCartItems, newCheckedAll, newCheckedItems], [oldCartItems, oldCheckedAll, oldCheckedItems]) => {

        let cartItems = [];
        let total = 0;
        newCartItems.forEach((element, i) => {
            if (!validQuantity(element.quantity))
                element.quantity = 1;

            cartItems.push({
                id: element.id,
                quantity: element.quantity
            });

            gsap.to(loadedCartItems.value[i], { duration: 0.1, productSum: Number(element.unit_price * element.quantity) || 0 })
            if(newCheckedItems.indexOf(i) >= 0 )
                total += element.productSum

        });
        gsap.to(totalAmount, { duration: 0.1, value: Number(total) || 0 })
        saveCart(cartItems);



        if (newCheckedAll && !oldCheckedAll && newCheckedItems.length != newCartItems.length) {
            checkedItems.value = [];

            loadedCartItems.value.forEach((element, i) => {
                checkedItems.value.push(i);
            });
        }
        if (newCheckedAll && oldCheckedAll && newCheckedItems.length != newCartItems.length) {
            checkedAll.value = false
        }
        if (!newCheckedAll && !oldCheckedAll && newCheckedItems.length == newCartItems.length) {
            checkedAll.value = true;
        }
        if (!newCheckedAll && oldCheckedAll && newCheckedItems.length == newCartItems.length) {
            checkedItems.value = [];
        }

    })

</script>

<template>
    <AppLayout title="Khám phá">
        <!-- HEADER -->
        <template #header>

        </template>

        <template v-slot="scope">
            <div class="container mx-auto mb-8">
                <div class="flex my-4 py-0 justify-between items-center">
                    <div class="flex gap-4">
                        <button v-show="checkedItems.length > 0" @click.prevent="deleteCartItems"
                        class="btn btn-md btn-square btn-primary gap-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
</svg>
</button>
                        <button v-show="checkedItems.length > 0" @click.prevent=""
                        class="btn btn-md btn-primary">Thanh toán</button>
                    </div>
                    <div class="flex flex-col bg-base-100 text-accent rounded-box p-4 text-left">
                        <span class="text-xl font-bold">Tạm tính: {{ Intl.NumberFormat('vi-VN', {
                                                    style: 'currency', currency:
                                                        'VND'
                                                }).format(totalAmount) }}</span>
                        <span class="text-md text-black font-semibold">Số sản phẩm đã chọn: {{ checkedItems.length }}</span>
                    </div>

                </div>

                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-box overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-5 py-5 bg-white border-b border-gray-200 text-left">
                                        <label>
                                            <input type="checkbox" class="checkbox checkbox-accent" v-model="checkedAll" />
                                        </label>
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-5 bg-white border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-bold">
                                        Sản phẩm
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-5 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-bold">
                                        Đơn giá
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-5 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-bold">
                                        Số lượng
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-5 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-bold">
                                        Số tiền
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, i) in loadedCartItems" :key="i">
                                    <th scope="col" class="px-5 py-5 bg-white border-b border-gray-200 text-left">

                                        <label>
                                            <input type="checkbox" class="checkbox checkbox-primary" :value="i" v-model="checkedItems" />
                                        </label>
                                    </th>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <a href="#" class="block relative">
                                                    <img :alt="item.name"
                                                        :src="item.product_images.find((priority) => priority != null).url"
                                                        class="mx-auto object-cover rounded-full h-10 w-10 " />
                                                </a>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ item.name }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ Intl.NumberFormat('vi-VN', {
                                                    style: 'currency', currency:
                                                        'VND'
                                                }).format(item.unit_price)
                                            }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="form-control">
                                            <div class="input-group input-group-sm">
                                                <button class="btn btn-square  btn-primary  btn-sm"
                                                    @click.prevent="(item.quantity)--;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M3 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                </button>
                                                <input min="1" type="number" v-model="item.quantity"
                                                    class="input input-sm input-bordered input-number-none text-center w-16" />
                                                <button class="btn btn-square btn-primary btn-sm"
                                                    @click.prevent="(item.quantity)++;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path
                                                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                    </svg>

                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="text-accent font-bold whitespace-no-wrap">
                                            {{ Intl.NumberFormat('vi-VN', {
                                                    style: 'currency', currency:
                                                        'VND'
                                                }).format(item.productSum)
                                            }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </template>





    </AppLayout>
</template>


<style>
:root {
    /* Color */
    --vc-clr-primary: #9C4146;
    --vc-clr-secondary: #775657;
    --vc-clr-white: #ffffff;
}

/* .carousel__prev,
    .carousel__next {
    box-sizing: content-box;
    border: 5px solid #F3F4F6;
    }

    .carousel__prev {
    left: 8px;
    }

    .carousel__next {
    right: 8px;
    } */
</style>
