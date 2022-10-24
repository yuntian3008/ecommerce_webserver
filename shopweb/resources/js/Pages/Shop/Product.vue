<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import VueCarouselImageItem from '@/Components/VueCarousel/VueCarouselImageItem.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import ProductCard from '@/Components/App/ProductCard.vue';
import HoverableProductCard from '@/Components/App/HoverableProductCard.vue';
import Rating from '../../Components/App/Rating.vue';


defineProps({
    carouselImages: Array,
    homeHeaderSvg: String,
})

const carouselData = ref();

</script>

<template>
    <AppLayout title="Khám phá">
        <!-- HEADER -->
        <template #header>

        </template>

        <template v-slot="scope">
            <div class="container mx-auto mb-8">
                <div class="flex flex-col xl:flex-row gap-8">
                    <div class="md:basis-9/12">
                        <div class="hero">
                            <div class="hero-content flex-col md:flex-row gap-12 p-0">
                                <img src="https://placeimg.com/400/400/arch" class="w-full rounded-box" />
                                <div class="flex flex-col">
                                    <h1 class="text-3xl font-semibold">Lorem Ipsum is simply dummy text of the printing and typesetting industry</h1>
                                    <h1 class="text-5xl font-bold py-4">255.000 đ</h1>
                                    <p class="pb-6 hidden lg:block">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </p>
                                    <Rating :rate="3.2" class="pb-6"/>
                                    <div class="justify-end flex gap-2">
                                        <button class="btn btn-secondary">Thêm vào giỏ</button>
                                        <button class="btn btn-primary">Mua ngay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:hidden flex-1">
                        <div class="pb-4 w-full flex justify-center font-bold">MÔ TẢ</div>
                        <p class="pb-6">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </p>
                    </div>
                    <div class="md:flex-1">
                        <div class="pb-4 w-full flex justify-center font-bold">THÔNG SỐ</div>
                        <div class="bg-base-100 font-semibold overflow-hidden rounded-box">
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-bold text-primary">
                                            Full name
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                            Mickael Poulaz
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-bold text-primary">
                                            Best techno
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                            React JS
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-bold text-primary">
                                            Email address
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                            m.poul@example.com
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-bold text-primary">
                                            Salary
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                            $10,000
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-bold text-primary">
                                            About
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                            To get social media testimonials like these, keep your customers engaged
                                            with your social media accounts by posting regularly yourself
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
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
