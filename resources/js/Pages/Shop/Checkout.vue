<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import gsap from 'gsap';
import { useStore } from 'vuex'
import { computed, reactive, ref, toRaw } from '@vue/reactivity';
import { watch } from '@vue/runtime-core';
import Swal from 'sweetalert2'
import AddressManagement from '@/Components/App/AddressManagement.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useToast } from 'vue-toastification';

const store = useStore()

const toast = useToast()

const props = defineProps({
    addresses: Array
})


const order = reactive({
    address_id: null,
})

const orderItems = computed(() => {
    return store.state.cart.selected.map(({ data, ...rest }) => {
        return rest
    })
})

const chooseAddress = (selected) => {
    order.address_id = selected.id
}

const checkout = () => {

    if (order.address_id == null) {
        toast.error("Vui lòng thêm hoặc chọn thông tin giao hàng");
        return
    }



    let url = route('order.store', order.address_id)

    let data = {
        order_items: [...orderItems.value]
    }

    // console.log(data)

    if (data.order_items.length == 0) {
        toast.error("Giỏ hàng trống, không thể đặt hàng")
        return
    }

    store.commit('cart/SPLICE_CART');

    Inertia.post(url, data)
}



</script>

<template>
    <AppLayout title="Thanh toán">
        <!-- HEADER -->
        <template #header>

        </template>

        <div class="container mx-auto mb-8">
            <div class="flex flex-row gap-x-6">
                <div class="basis-1/3">
                    <h2 class="mb-6 text-2xl font-extrabold text-gray-900 dark:text-white w-full">Tóm tắt đơn hàng:
                    </h2>
                    <div class="flex flex-col border border-gray-200 rounded-lg divide-y">
                        <div
                            class="inline-flex p-5 items-center justify-between font-bold text-lg bg-gray-100 rounded-t-lg">
                            <span>Sản phẩm</span>
                            <span>Tổng</span>
                        </div>
                        <Link :href="item.data.url" class="inline-flex gap-x-4 p-5 items-center"
                            v-for="(item, i) in store.state.cart.selected" :key="i">
                        <img :src="item.data.image.url" class="w-16 rounded-md border border-gray-200">
                        <div class="grow flex flex-col gap-y-2">
                            <span class="font-bold text-md leading-none">{{ item.data.name }}</span>
                            <span class="font-extrabold text-sm text-gray-500">{{ `${item.quantity} X
                                                            ${Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND'
                                }).format(item.data.unit_price)}`
                            }}</span>
                        </div>
                        <span class="font-bold text-md leading-none">

                            {{ Intl.NumberFormat('vi-VN', {
                                    style: 'currency', currency: 'VND'
                                }).format(item.quantity
                                    * item.data.unit_price)
                            }}
                        </span>

                        </Link>
                        <div class="inline-flex flex-col">
                            <div class="inline-flex px-5 py-2 items-center justify-between font-semibold text-lg">
                                <span>Tạm tính</span>
                                <span>{{ Intl.NumberFormat('vi-VN', {
                                        style: 'currency',
                                        currency: 'VND'
                                    }).format(store.getters['cart/cartTotalAmount'])
                                }}</span>
                            </div>
                            <div class="inline-flex px-5 py-2 items-center justify-between font-semibold text-lg">
                                <span>Phí giao hàng </span>
                                <span>{{ Intl.NumberFormat('vi-VN', {
                                        style: 'currency', currency: 'VND'
                                    }).format(0)
                                }}</span>
                            </div>
                            <div class="inline-flex px-5 py-2 items-center justify-between font-semibold text-lg">
                                <span>Giảm giá </span>
                                <span>- {{ Intl.NumberFormat('vi-VN', {
                                        style: 'currency', currency: 'VND'
                                    }).format(0
                                    )
                                }}</span>
                            </div>
                        </div>

                        <div class="inline-flex px-5 py-3 items-center justify-between font-bold text-lg rounded-b-lg">
                            <span>Tổng đơn hàng </span>
                            <span>{{ Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(
                                    store.getters['cart/cartTotalAmount'])
                            }}</span>
                        </div>
                    </div>
                </div>
                <div class="basis-2/3">
                    <div class="flex flex-row gap-x-4">
                        <div class="inline-flex flex-col grow">
                            <h2 class="mb-6 text-2xl font-extrabold text-gray-900 dark:text-white">Thông tin cá
                                nhân:</h2>
                            <ul class="space-y-1 max-w-md list-none list-inside text-gray-700 dark:text-gray-400">
                                <li>
                                    <span class="">Họ tên: </span> <span class="font-extrabold"> {{
                                            $page.props.user.name
                                    }} </span>
                                </li>
                                <li>
                                    <span class="">Địa chỉ email: </span> <span class="font-extrabold"> {{
                                            $page.props.user.email
                                    }} </span>
                                </li>
                            </ul>

                            <h2 class="mt-6 mb-6 text-2xl font-extrabold text-gray-900 dark:text-white">Phương thức
                                thanh toán:</h2>
                            <div class="grid grid-cols-2 gap-2">
                                <div
                                    class="flex w-full items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input checked id="bordered-radio-1" type="radio" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-1"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Tiền
                                        mặt khi nhận hàng</label>
                                </div>
                                <div
                                    class="flex w-full items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input id="bordered-radio-2" type="radio" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-2"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Momo</label>
                                </div>
                                <div
                                    class="flex w-full items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input id="bordered-radio-3" type="radio" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-3"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Zalopay</label>
                                </div>
                                <div
                                    class="flex w-full items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input type="radio" id="bordered-radio-4" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-4"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">VN
                                        pay</label>
                                </div>
                                <div
                                    class="flex w-full items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input type="radio" value="" id="bordered-radio-5" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-5"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Viettel
                                        Pay</label>
                                </div>
                                <div
                                    class="flex w-full items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input type="radio" id="bordered-radio-6" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-6"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Shoppee
                                        Pay</label>
                                </div>
                                <div
                                    class="flex w-full items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input id="bordered-radio-7" type="radio" value="" name="bordered-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="bordered-radio-7"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Visa/Mastercard</label>
                                </div>
                            </div>

                            <button type="button" @click.prevent="checkout"
                                class="mt-4 text-white text-lg bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 shadow-lg shadow-yellow-500/50 dark:shadow-lg dark:shadow-yellow-800/80 font-bold rounded-lg px-5 py-2.5 text-center mr-2 mb-2 ">ĐẶT
                                HÀNG</button>
                        </div>
                        <div class="inline-flex flex-col">
                            <h2 class="mb-6 text-2xl font-extrabold text-gray-900 dark:text-white">Địa điểm giao
                                hàng:</h2>
                            <AddressManagement :addresses="props.addresses" @choose="chooseAddress" />
                        </div>

                    </div>

                </div>
            </div>

        </div>






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
