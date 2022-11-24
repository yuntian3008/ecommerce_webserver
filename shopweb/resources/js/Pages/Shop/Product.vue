<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed, ref } from 'vue';
import VueCarouselImageItem from '@/Components/VueCarousel/VueCarouselImageItem.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import ProductCard from '@/Components/App/ProductCard.vue';
import HoverableProductCard from '@/Components/App/HoverableProductCard.vue';
import Rating from '../../Components/App/Rating.vue';
import { useStore } from 'vuex';
import { useToast } from 'vue-toastification';


const props = defineProps({
    carouselImages: Array,
    product: Object,
    homeHeaderSvg: String,
})

const toast = useToast()

const store = useStore()

const addToCart = (id) => store.dispatch('cart/addToCart', {
    id: props.product.id,
    callback: (r) => {
        if (r == 'success')
            toast.success("Thêm vào giỏ hàng thành công", { timeout: 1500 })
    }
})

const specs = computed(() => {
    return JSON.parse(props.product.specs)
})

</script>

<template>
    <AppLayout :title="product.name">
        <!-- HEADER -->
        <template #header>

        </template>

        <div class="container mx-auto mb-8">
            <div class="grid grid-cols-6 gap-8">
                <div class="col-span-6 md:col-span-2 px-4 md:px-0">
                    <Carousel class="border border-gray-200 rounded-xl">
                        <Slide v-for="(image, i) in product.product_images" :key="i">
                            <div class="carousel__item">
                                <img :src="image.url" alt="">
                            </div>
                        </Slide>

                        <template #addons>
                            <Navigation />
                        </template>
                    </Carousel>
                </div>
                <div class="col-span-6 md:col-span-4">
                    <div class="flex flex-col">
                        <h1
                            class="text-2xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
                            {{ product.name }}</h1>
                        <hr class="my-4 mx-auto w-48 h-1 bg-gray-100 rounded border-0 md:my-10 dark:bg-gray-700" />
                        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">{{ product.desc
                        }}</p>

                        <h1
                            class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-5xl dark:text-white">
                            {{ Intl.NumberFormat('vi-VN', {
        style: 'currency', currency:
            'VND'
    }).format(product.unit_price)
                            }}</h1>
                        <h2 v-if="specs.length > 0" class="mb-6 text-xl font-bold text-gray-500 lg:text-xl dark:text-gray-400">Thông số sản phẩm
                        </h2>
                        <div v-if="specs.length > 0">
                            <dl class="max-w-">
                                <div v-for="(spec, i) in specs" :key="i">
                                    <dt>{{ spec.key }}</dt>
                                    <dd>{{ spec.value }}</dd>
                                </div>


                            </dl>
                        </div>
                        <div>
                            <button @click.prevent="addToCart" type="button" class="inline-flex items-center gap-x-2 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-lg px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
  <path d="M1 1.75A.75.75 0 011.75 1h1.628a1.75 1.75 0 011.734 1.51L5.18 3a65.25 65.25 0 0113.36 1.412.75.75 0 01.58.875 48.645 48.645 0 01-1.618 6.2.75.75 0 01-.712.513H6a2.503 2.503 0 00-2.292 1.5H17.25a.75.75 0 010 1.5H2.76a.75.75 0 01-.748-.807 4.002 4.002 0 012.716-3.486L3.626 2.716a.25.25 0 00-.248-.216H1.75A.75.75 0 011 1.75zM6 17.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15.5 19a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
</svg>
Thêm vào giỏ hàng</button>
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

        dt {
            float: left;
            clear: left;
            width: 100%;
            max-width: 8rem;
            font-weight: bold;
        }

        dt::after {
            content: ":";
        }

        dd {
            margin: 0 0 0 80px;
            padding: 0 0 0.5em 0;
        }
</style>
