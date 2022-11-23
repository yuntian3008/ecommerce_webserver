<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { computed, ref } from '@vue/reactivity';
import { useStore } from 'vuex';

const store = useStore()


</script>

<template>
    <div>
        <Link :href="route('cart')"
            class=" relative inline-flex text-gray-800  hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm p-2.5 text-center">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
        </span>
        <span
            class=" absolute -right-1 -top-1 inline-flex items-center justify-center text-xs p-1 w-5 h-5 font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-200 dark:text-blue-800">
            {{ store.getters['cart/cartLength'] }}
        </span>
        </Link>
    </div>
</template>
