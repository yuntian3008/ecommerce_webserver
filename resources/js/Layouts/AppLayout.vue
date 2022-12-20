<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import MenuItemLink from '@/Components/DaisyUI/MenuItemLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import CartMenu from '@/Components/App/CartMenu.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
defineProps({
    title: String,
});

const scrolling = ref()
const showingNavigationDropdown = ref(false);
// const cartRef = ref()

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const searching = (e) => {
    Inertia.get(route('search', {
        s: e.target.value
    }))
}

const logout = () => {
    Inertia.post(route('logout'));
};

function isTouchDevice() {
    return window.ontouchstart !== undefined;
}

// const addToCart = (id) => {
//     cartRef.value.addToCart(id);
// }

// const syncCart = () => {
//     cartRef.value.syncCart();
// }



</script>

<template>
    <div class="flex flex-col p-4 bg-neutral min-h-screen relative">

        <Head :title="title" />

        <Banner />
        <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
            <div class="container flex flex-wrap gap-x-4 items-center justify-between mx-auto">
                <Link :href="route('home')" class="flex items-center">
                <ApplicationLogo :width="6" :height="6" />
                <span class="ml-3 self-center text-xl font-semibold whitespace-nowrap dark:text-white">Meo Meo
                    Shop</span>
                </Link>

                <div class="ml-8 grow flex items-center justify-start gap-x-6 relative">
                    <Link :href="route('home')"
                        class="inline-flex items-center font-semibold gap-x-1 text-gray-700 dark:text-blue-500 hover:text-yellow-500">
                    Trang
                    chủ</Link>
                    <Menu>
                        <MenuButton href="#"
                            class="inline-flex items-center font-semibold gap-x-1 text-gray-700 dark:text-blue-500 hover:text-yellow-500">
                            Danh
                            mục
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </MenuButton>
                        <MenuItems as="div"
                            class="z-20 scrollbar-thin scrollbar-thumb-yellow-700 scrollbar-track-gray-300 scrollbar-thumb-rounded-full scrollbar-track-rounded-full border border-gray-200 rounded-lg bg-white absolute top-10 inset-x-auto mt-2 origin-top-right overflow-y-scroll w-full h-32 max-w-xl">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                <li v-for="(category, i) in $page.props.categories" :key="i">
                                    <MenuItem>
                                    <Link :href="category.url"
                                        class="cursor-pointer block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ category.name }}</Link>
                                    </MenuItem>
                                </li>

                            </ul>
                        </MenuItems>
                    </Menu>

                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <input type="text" id="search-navbar" @keyup.enter="searching"
                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                        placeholder="Search...">
                </div>
                <CartMenu ref="cartRef" />
                <div class="flex items-center" v-if="$page.props.user">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button v-if="$page.props.jetstream.managesProfilePhotos"
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url"
                                    :alt="$page.props.user.name">
                            </button>

                            <span v-else class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ $page.props.user.name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <!-- Account Management -->


                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Đơn hàng
                            </div>

                            <DropdownLink :href="route('order.index')">
                                Lịch sử đơn hàng
                            </DropdownLink>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Quản lí tài khoản
                            </div>

                            <DropdownLink :href="route('profile.show')">
                                Hồ sơ của bạn
                            </DropdownLink>

                            <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                API Tokens
                            </DropdownLink>

                            <div class="border-t border-gray-100" />

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <DropdownLink as="button">
                                    Đăng xuất
                                </DropdownLink>
                            </form>
                        </template>
                    </Dropdown>
                </div>
                <div class="flex items-center gap-x-2" v-else>
                    <Link :href="route('login')"
                        class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                    Đăng
                    nhập</Link>
                    <Link v-if="$page.props.canRegister" :href="route('register')"
                        class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                    Đăng
                    kí</Link>
                </div>

            </div>
        </nav>
        <!-- <div class="container mx-auto z-20 fixed top-0 right-0 left-0">
            <div class="navbar bg-base-100 rounded-box my-2 bg-opacity-75">
                <div class="flex-1">
                    <Link :href="route('home')" class="px-2">

                    </Link>
                </div>
                <div class="flex-none gap-2">

                    <CartMenu ref="cartRef" />
                    <div v-if="$page.props.user" class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img class="" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                            </div>
                        </label>
                        <ul tabindex="0"
                            class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                            <li class="menu-title">
                                <span>Tài khoản</span>
                            </li>
                            <MenuItemLink :href="route('profile.show')">
                                Cài đặt tài khoản
                            </MenuItemLink>

                            <form @submit.prevent="logout">
                                <MenuItemLink isButton="true">
                                    Đăng xuất
                                </MenuItemLink>
                            </form>
                        </ul>
                    </div>
                    <ul class="menu menu-compact menu-horizontal p-2 rounded-box" v-else>
                        <MenuItemLink :href="route('login')" :active="route().current('login')">Login</MenuItemLink>
                        <MenuItemLink v-if="$page.props.canRegister" :href="route('register')"
                            :active="route().current('register')">Create a new account</MenuItemLink>
                    </ul>
                </div>
            </div>
        </div> -->


        <!-- Page Heading -->

        <slot name="header" />


        <!-- Page Content -->
        <main class="z-10 mt-12">
            <slot></slot>
        </main>

        <footer class="footer p-10 bg-base-100 rounded-box text-neutral-content">
            <div>
                <svg width="50" height="50" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                    clip-rule="evenodd" class="fill-current">
                    <path
                        d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z">
                    </path>
                </svg>
                <p>MeoMeoShop Ltd.<br>Cung cấp dụng cụ pha chế từ 1992</p>
            </div>
            <div>
                <span class="footer-title">Social</span>
                <div class="grid grid-flow-col gap-4">
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                            </path>
                        </svg></a>
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
                            </path>
                        </svg></a>
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
                            </path>
                        </svg></a>
                </div>
            </div>
        </footer>
    </div>

</template>
