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

const store = useStore()

const props = defineProps({
    order: Object,
})

const statusPercent = computed(() => {
    let percent = 0;
    switch (props.order.state) {
        case 1:
            percent = 0;
            break;
        case 2:
            percent = 25;
            break;
        case 3:
            percent = 50;
            break;
        case 4:
            percent = 75;
            break;
        case 5:
            percent = 100;
            break;
        default:
            percent = 0;
            break;
    }

    return percent

})



</script>

<template>
    <AppLayout :title="`Đơn hàng #${order.id}`">
        <!-- HEADER -->
        <template #header>

        </template>

        <div class="container mx-auto mb-8">
            <h2 class="text-4xl font-extrabold dark:text-white mb-4">Chi tiết đơn hàng</h2>
            <div class="flex justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold dark:text-white">Đơn hàng #{{ order.id }}</h2>
                    <a href="#" class="text-base text-gray-500 underline dark:text-white">Xem hóa đơn</a>
                </div>
                <div>
                    <Link :href="route('order.index')"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 mr-2 -ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>
                    Quay về
                    </Link>
                </div>
            </div>

            <hr class="mt-8 mb-8" />

            <div class="grid grid-cols-4">
                <div>
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Thông tin cá nhân: </h2>
                    <ul class="space-y-1 max-w-md list-none list-inside text-gray-500 dark:text-gray-400">
                        <li>
                            Họ tên: {{ $page.props.user.name }}
                        </li>
                        <li>
                            Email: {{ $page.props.user.email }}
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Địa chỉ giao hàng: </h2>
                    <ul class="space-y-1 max-w-md list-none list-inside text-gray-500 dark:text-gray-400">
                        <li>
                            {{ order.address.address }} - {{ order.address.province }} - {{ order.address.country }}
                        </li>
                        <li>
                            SĐT giao hàng: {{ order.address.phone_number }}
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Thông tin đơn hàng: </h2>
                    <ul class="space-y-1 max-w-md list-none list-inside text-gray-500 dark:text-gray-400">
                        <li>
                            Số sản phẩm: {{ order.orderitems.length }}
                        </li>
                        <li>
                            Được tạo lúc: {{ order.created_at }}
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Tình trạng đơn hàng: </h2>
                    <ul class="space-y-1 max-w-md list-none list-inside text-gray-500 dark:text-gray-400">
                        <li>
                            Thanh toán: Thành công
                        </li>
                        <li>
                            Trạng thái: {{ order.state_name }}
                        </li>
                    </ul>
                </div>


            </div>

            <div class="mt-8 grid grid-cols-3 divide-x content-center place-content-center">
                <div class="col-span-2">
                    <div class="flex flex-col ">
                        <Link :href="item.product.url" class="inline-flex gap-x-4 p-5 items-center"
                            v-for="(item, i) in order.orderitems" :key="i">
                        <img :src="item.product.image.url" class="w-16 rounded-md border border-gray-200">
                        <div class="grow flex flex-col gap-y-2">
                            <span class="font-bold text-md leading-none">{{ item.product.name }}</span>
                            <span class="font-extrabold text-sm text-gray-500">{{ `${item.quantity} X
                                                            ${Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND'
                                }).format(item.final_unit_price)}`
                            }}</span>
                        </div>
                        <span class="font-bold text-md leading-none">

                            {{ Intl.NumberFormat('vi-VN', {
                                    style: 'currency', currency: 'VND'
                                }).format(item.quantity
                                    * item.final_unit_price)
                            }}
                        </span>

                        </Link>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col">
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
                        <div
                            class="inline-flex px-5 py-3 items-center justify-between font-bold text-xl rounded-b-lg border-t">
                            <span>Tổng đơn hàng </span>
                            <span>{{ Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(
                                    store.getters['cart/cartTotalAmount'])
                            }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="border p-8 rounded-xl mt-8">


                <div class="flex justify-between mb-1">
                    Cập nhật lần cuối: {{ order.updated_at }}
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-yellow-600 h-2.5 rounded-full" :style="`width: ${statusPercent}%`"></div>
                </div>
                <div class="flex justify-between mt-1">
                    <span class="text-sm font-bold text-yellow-700 dark:text-white">{{ order.state == 0 ? `Đã hủy đơn` :
                            `Chờ xác nhận`
                    }} </span>
                    <span class="text-sm font-bold text-yellow-700 dark:text-white">Đã xác nhận</span>
                    <span class="text-sm font-bold text-yellow-700 dark:text-white">Đã đóng gói</span>
                    <span class="text-sm font-bold text-yellow-700 dark:text-white">Đang được giao</span>
                    <span class="text-sm font-bold text-yellow-700 dark:text-white">Đã giao thành công</span>
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
