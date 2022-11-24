<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import gsap from 'gsap';
import { useStore } from 'vuex'
import { computed, reactive, ref, toRaw } from '@vue/reactivity';
import { watch } from '@vue/runtime-core';
import Swal from 'sweetalert2'

const store = useStore()

const data = reactive({
    selected: store.state.cart.items,
})

const selectAll = computed({
    get() {
        return store.state.cart.items ? data.selected.length == store.state.cart.items.length : false
    },

    set(value) {
        let selected = []

        if (value) {
            selected = [...store.state.cart.items]
        }

        data.selected = selected
    }
})

const totalAmount = computed(() => {
    let total = 0;
    data.selected.forEach((item) => {
        total += item.quantity * item.data.unit_price
    })
    return total
})

const tweenedTotalAmount = reactive({
    totalAmount: 0,
})

const deleteCartItems = async (i) => {
    const { isConfirmed } = await Swal.fire({
        text: "Xóa sản phẩm này khỏi giỏ hàng ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy',
        cancelButtonColor: 'gray'
    })

    if (isConfirmed)

        store.commit('cart/REMOVE_CART_ITEMS', i)


}

const checkout = () => {

    store.commit("SET_SELECTED", data.selected)

    Inertia.get(route('checkout'));
}

watch(
    totalAmount, (totalAmount) => {
        gsap.to(tweenedTotalAmount, { duration: 0.5, totalAmount: Number(totalAmount) || 0 })
    },
    {
        immediate: true
    }
)

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
                        <!-- <button v-show="data.length > 0" @click.prevent="deleteCartItems"
                            class="btn btn-md btn-square btn-primary gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button> -->
                        <button @click="checkout" v-if="data.selected.length > 0"
                            class="inline-flex items-center gap-x-2 text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-semibold rounded-lg text-md px-6 py-4 mr-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">Thanh
                            toán
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
</svg>
</button>
                    </div>
                    <div class="flex flex-col bg-base-100 text-accent rounded-box p-4 text-left">
                        <span class="text-xl font-bold">Tạm tính: {{ Intl.NumberFormat('vi-VN', {
                                style: 'currency', currency:
                                    'VND'
                            }).format(tweenedTotalAmount.totalAmount.toFixed(0))
                        }}</span>
                        <span class="text-md text-black font-semibold">Số sản phẩm đã chọn: {{ data.selected.length
                        }}</span>
                    </div>

                </div>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" v-model="selectAll"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                    </div>
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Product
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Qty
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Price
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="store.getters['cart/cartLength'] == 0">
                                <td colspan="10000">
                                    <div class="flex justify-center text-center py-4">
                                        <span>
                                            Không có sản phẩm
                                        </span>    </div>
                                </td>
                            </tr>
                            <tr v-for="(item, i) in store.state.cart.items" :key="i"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4 w-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" v-model="data.selected" :value="item"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                    </div>
                                </td>
                                <td class="p-4 w-32">
                                    <img :src="item.data.image.url" alt="Apple Watch">
                                </td>
                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                    {{ item.data.name }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <button @click.prevent="store.commit('cart/DECREASE_QUANTITY', i)"
                                            class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white rounded-full border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                            type="button">
                                            <span class="sr-only">Quantity button</span>
                                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        <div>
                                            <input type="number" min="1" v-model.number="item.quantity" @input="store.commit('cart/CHANGE_QUANTITY', {
                                                index: i,
                                                quantity: item.quantity
                                            })" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="1" required>
                                        </div>
                                        <button @click.prevent="store.commit('cart/INCREASE_QUANTITY', i)"
                                            class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white rounded-full border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                            type="button">
                                            <span class="sr-only">Quantity button</span>
                                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                    {{ Intl.NumberFormat('vi-VN', {
                                            style: 'currency', currency:
                                                'VND'
                                        }).format(item.data.unit_price)
                                    }}
                                </td>
                                <td class="py-4 px-6">
                                    <a href="#" @click.prevent="deleteCartItems(i)"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- <div class="overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-box overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-5 py-5 bg-white border-b border-gray-200 text-left">
                                        <label>
                                            <input type="checkbox" class="checkbox checkbox-accent"
                                                v-model="checkedAll" />
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
                                            <input type="checkbox" class="checkbox checkbox-primary" :value="i"
                                                v-model="checkedItems" />
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
                </div> -->
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
