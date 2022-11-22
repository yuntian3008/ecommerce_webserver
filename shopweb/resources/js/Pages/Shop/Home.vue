<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import VueCarouselImageItem from '@/Components/VueCarousel/VueCarouselImageItem.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import ProductCard from '@/Components/App/ProductCard.vue';
import HoverableProductCard from '@/Components/App/HoverableProductCard.vue';


const props = defineProps({
    products: Array,
    homeHeaderSvg: String,
})

const carouselData = ref();

console.log(props.products)

</script>

<template>
    <AppLayout title="Khám phá" >
        <!-- HEADER -->
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
                    <ProductCard class="absolute right-32 top-32 shadow-none" size="large" :imgAspectRatio="'4/3'" name="Simple Machine" price="$40" image="http://localhost:8000/dev_assets/cm1.webp"/>
                </div>
            </div>
        </template>

        <template v-slot="{ addToCart }">
            <div class="container mx-auto mb-8">
                <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-16">
                    <HoverableProductCard v-for="product in products.data" :key="product.id" :id="product.id"  @addToCart="addToCart" :slug="route('product', { 'product': product.slug})" :name="product.name" :price="product.unit_price" :image="product.image.url"/>
                </div>
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
