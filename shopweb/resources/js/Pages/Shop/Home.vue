<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, reactive, ref, toRef, toRefs } from 'vue';
import VueCarouselImageItem from '@/Components/VueCarousel/VueCarouselImageItem.vue';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import HeaderProductCard from '@/Components/App/HeaderProductCard.vue';
import ProductCard from '@/Components/App/ProductCard.vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';
import { useStore } from 'vuex';
import { useToast } from 'vue-toastification';


const props = defineProps({
    products: Array,
    homeHeaderSvg: String,
})

const data = reactive({
    products: props.products.data,
    pagination: props.products,
    loading: false,
});

const toast = useToast();
const store = useStore();

const addToCart = (id) => store.dispatch('cart/addToCart', {
    id: id,
    callback: (r) => {
        if (r == 'success')
            toast.success("Thêm vào giỏ hàng thành công", { timeout: 1500 })
    }
})

const loadMoreIntersect = ref(null);

const loadMoreProducts = async () => {
    if (data.pagination.next_page_url == null) {
        return
    }

    data.loading = true
    try {
        const result = await axios.get(data.pagination.next_page_url);
        data.products = [...data.products, ...result.data.data]
        data.pagination = result.data;
    }
    catch (e) {
        console.log(e)
    }
    finally {
        data.loading = false
    }
}

console.log(loadMoreIntersect)

onMounted(() => {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => entry.isIntersecting && loadMoreProducts(), {
        rootMargin: "-150px 0px 0px 0px"
    }));

    observer.observe(loadMoreIntersect.value)
});





</script>

<template>
    <AppLayout title="Khám phá">
        <!-- HEADER -->
        <template #header>
            <div class="container mx-auto z-0 pt-32">
                <div class="flex gap-8 items-stretch z-0">
                    <div class="basis-2/5 flex flex-col justify-center gap-4">
                        <span class="text-7xl font-bold font-sans">
                            Một trong tất cả các giải pháp về thiết bị, công cụ pha chế
                        </span>
                        <span class="text-gray-700 text-lg">
                            Bạn chỉ cần ở đây và tìm kiếm, chọn lựa theo sở thích của bạn. Máy pha Espresso hiện đại,
                            dụng
                            cụ pha chế, những ly Latte tuyệt đẹp qua sự chọn lựa tuyệt vời của bạn. Xây dựng ngay giấc
                            mơ
                            của một Barista chuyên nghiệp.
                        </span>
                    </div>
                    <div class="basis-3/5 relative">
                        <img class="w-full -mt-20  z-0" :src="homeHeaderSvg" alt="" />
                        <HeaderProductCard class="absolute right-32 top-32 shadow-none rounded-lg" size="large"
                            :imgAspectRatio="'4/3'" name="Mixissua Machine" price="2.499.000 đ"
                            image="https://mms.cielot.com/storage/product-image/xTie4U-1669110883.jpg" />
                    </div>
                </div>
            </div>

        </template>

        <div class="container mx-auto mb-8">
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-16">
                <ProductCard v-for="product in data.products" :key="product.id" :product="product"
                    @addToCart="addToCart" />
                <span ref="loadMoreIntersect" />
                <div class="col-span-full" v-if="data.loading">
                    <div class="flex justify-center">
                        <div role="status">
                            <svg class="inline mr-2 w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
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
