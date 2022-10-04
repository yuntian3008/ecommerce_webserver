<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import VueCarouselImageItem from '@/Components/VueCarousel/VueCarouselImageItem.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import ProductCard from '@/Components/App/ProductCard.vue';


defineProps({
    carouselImages: Array,
    homeHeaderSvg: String,
})

const carouselData = ref();

</script>

<template>
    <AppLayout title="Khám phá">
        <template #header>
            <div class="flex gap-8 items-stretch z-0">
                <div class="basis-2/5 flex flex-col justify-center gap-4">
                    <span class="text-7xl font-bold font-sans">
                        Một trong tất cả các giải pháp về thiết bị, công cụ pha chế
                    </span>
                    <span class="text-gray-700 text-lg">
                        Bạn chỉ cần ở đây và tìm kiếm, chọn lựa theo sở thích của bạn. Máy pha Espresso hiện đại, dụng cụ pha chế, những ly Latte tuyệt đẹp qua sự chọn lựa tuyệt vời của bạn. Xây dựng ngay giấc mơ của một Barista chuyên nghiệp.
                    </span>
                </div>
                <div class="basis-3/5 relative">
                    <img class="w-full -mt-20  z-0" :src="homeHeaderSvg" alt=""/>
                    <ProductCard class="absolute right-32 top-32 shadow-none" size="large" :imgAspectRatio="'4/3'" name="Simple Machine" price="$40" image="https://placeimg.com/400/225/arch"/>
                </div>

                <!-- <div class="grow"></div>
                <div class="basis-1/5">
                    <ul class="menu bg-neutral text-neutral-content p-4 shadow-lg rounded-box">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>
                <div class="basis-3/5">
                    <div class="grid grid-rows-2 grid-flow-col gap-4">
                        <div class="row-span-2 col-span-2 relative">
                            <div class="carousel w-full rounded-box">
                                <div class="carousel-item w-full" v-for="( img, index) in $props.carouselImages" :key="i" :id="'item'+ index">
                                    <VueCarouselImageItem :src="img"/>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0">
                                    <div class="flex justify-center gap-x-2">
                                        <a class="bg-primary w-3 h-2 rounded-box" v-for="( img, index) in $props.carouselImages" :key="i" :href="'#item'+ index">
                                        </a>
                                    </div>

                                </div>

                        </div>
                        <div class="card card-compact bg-base-100 shadow-xl">
                            <figure><img src="https://placeimg.com/400/225/arch" alt="Shoes" /></figure>
                            <div class="card-body">
                                <h2 class="card-title">Shoes!</h2>
                                <p>If a dog chews shoes whose shoes does he choose?</p>
                                <div class="card-actions justify-end">
                                </div>
                            </div>
                        </div>
                        <div class="card card-compact bg-base-100 shadow-xl">
                            <figure><img src="https://placeimg.com/400/225/arch" alt="Shoes" /></figure>
                            <div class="card-body">
                                <h2 class="card-title">Shoes!</h2>
                                <p>If a dog chews shoes whose shoes does he choose?</p>
                                <div class="card-actions justify-end">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grow"></div> -->
            </div>
        </template>



    </AppLayout>
</template>


<style>
    :root{
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
