<script setup>
import { computed } from '@vue/reactivity';



const props = defineProps({
    name: {
        type: String,
        required: true
    },
    price: {
        type: String,
        required: true
    },
    image: {
        type: String,
        required: true
    },
    rating: {
        type: String,
        required: true
    },
});

const classes = computed(() => {
    let sizeClass;
    let buttonSize;
    let iconButtonSize;
    let titleTextSize;
    let priceTextSize;
    let ratingTextSize;
    let imageAspectRatio;

    buttonSize = 'btn-md'
    iconButtonSize = 'w-6 h-6'
    titleTextSize = 'text-2xl'
    priceTextSize = 'text-lg'
    ratingTextSize = 'text-md'

    return {
        button: 'btn btn-square btn-neutral ' + buttonSize,
        iconButton: iconButtonSize,
        title: 'font-bold ' + titleTextSize,
        price: 'text-base-200 ' + priceTextSize,
        rating: ratingTextSize,
        image: 'w-full rounded-lg ' + imageAspectRatio,
    } ;
});

</script>

<template>
    <div class="group flex flex-col justify-start gap-4 bg-white p-12 rounded-box bg-no-repeat h-96 bg-contain bg-center w-100 bg-origin-content" :style="'background-image: url(' + image + ')'">

        <div class="justify-between bg-secondary p-4 -m-6 hidden group-hover:flex animate__animated animate__fadeInUp rounded-box text-base-300 ">
            <div class="flex flex-col">
                <div :class="classes.title">{{ name }}</div>
                <div :class="classes.price">{{ price }}</div>
            </div>
            <div class="self-center">
                <button :class="classes.button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" :class="classes.iconButton">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


</template>
