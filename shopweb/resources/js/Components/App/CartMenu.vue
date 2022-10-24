<script setup>
import { computed, ref } from '@vue/reactivity';
import { onMounted } from '@vue/runtime-core';

const cartItems = ref([])

onMounted(() => {
    if (localStorage.cart)
        cartItems.value = JSON.parse(localStorage.cart);

    console.log(cartItems.value)
})

const upsertCart = (item) => {

    const index = cartItems.value.findIndex((e) => e.id === item.id);

    if (index === -1) {
        if (!item.quantity)
            item.quantity = 1;
            cartItems.value.push(item);
    } else {
        if (item.quantity)
            cartItems.value[index] = item;
        else
            cartItems.value[index].quantity++;
    }

    localStorage.cart = JSON.stringify(cartItems.value)
}

const addToCart = (product_id) => {
    upsertCart({
        id: product_id
    })
}


defineExpose({
    addToCart
})

</script>

<template>
    <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle">
            <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="badge badge-secondary badge-sm indicator-item">{{ cartItems.length }}</span>
            </div>
        </label>
        <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">
            <div class="card-body">
                <span class="font-bold text-lg">{{ cartItems.length }} sản phẩm</span>
                <span class="text-primary">Subtotal: $999</span>
                <div class="card-actions">
                    <button class="btn btn-primary btn-block">View cart</button>
                </div>
            </div>
        </div>
    </div>
</template>
