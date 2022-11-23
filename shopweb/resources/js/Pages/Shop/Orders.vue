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
import { Head, Link } from '@inertiajs/inertia-vue3';


const props = defineProps({
    orders: Array,
    homeHeaderSvg: String,
})

const data = reactive({
    orders: props.orders.data,
    pagination: props.orders,
    loading: false,
});

const toast = useToast();
const store = useStore();


const loadMoreIntersect = ref(null);

const loadMoreProducts = async () => {
    if (data.pagination.next_page_url == null) {
        return
    }

    data.loading = true
    try {
        const result = await axios.get(data.pagination.next_page_url);
        data.orders = [ ...data.orders , ...result.data.data]
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
        </template>

        <div class="container mx-auto mb-8">
            <h2 class="text-4xl font-extrabold dark:text-white mb-4">Lịch sử đơn hàng</h2>
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-16">
                <div v-for="order in data.orders"  :key="order.id" class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Đơn hàng #{{ order.id }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Số sản phẩm: {{ order.orderitems.length }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Tổng đơn hàng: {{ order.total_amount }}</p>
                    <span class="mt-4 bg-gray-100 text-gray-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ order.state_name }}</span>
                    <div class="flex justify-end">
                        <Link :href="route('order.show', order.id )" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Xem chi tiết
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </Link>
                    </div>

                </div>
                <span ref="loadMoreIntersect"/>
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
