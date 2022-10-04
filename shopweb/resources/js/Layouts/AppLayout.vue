<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import MenuItemLink from '@/Components/DaisyUI/MenuItemLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};

function isTouchDevice(){
    return window.ontouchstart !== undefined;
}

</script>

<template>
    <div class="flex flex-col p-4 bg-neutral min-h-screen relative">
        <div class="bg-gray-100 left-0 w-3/4 h- absolute z-0 -mt-4"></div>

        <Head :title="title" />

        <Banner />
        <div class="container mx-auto z-10">
            <div class="navbar bg-ghost rounded-box mb-4">
                <div class="flex-1">
                    <Link :href="route('home')" class="btn btn-ghost normal-case text-xl">
                        {{ $page.props.appName }}
                    </Link>
                    <!-- <ul class="menu menu-compact menu-horizontal gap-x-2 p-2">
                        <MenuItemLink :href="route('home')" :active="route().current('home')">
                            Trang chủ
                        </MenuItemLink>
                        <li tabindex="0">
                            <a>
                                Parent
                                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24">
                                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                                </svg>
                            </a>
                            <ul class="p-2 bg-base-100">
                                <li><a>Submenu 1</a></li>
                                <li><a>Submenu 2</a></li>
                            </ul>
                        </li>
                        <li><a>Item 3</a></li>
                    </ul> -->
                </div>
                <div class="flex-none gap-2">
                    <!-- <div class="form-control">
                        <div class="input-group">
                            <input type="text" placeholder="Search…" class="input input-bordered" />
                            <button class="btn btn-square btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div> -->
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="badge badge-secondary badge-sm indicator-item">8</span>
                            </div>
                        </label>
                        <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">
                            <div class="card-body">
                                <span class="font-bold text-lg">8 Items</span>
                                <span class="text-primary">Subtotal: $999</span>
                                <div class="card-actions">
                                    <button class="btn btn-primary btn-block">View cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <MenuItemLink isButton="true">
                                    Đăng xuất
                                </MenuItemLink>
                            </form>
                        </ul>
                    </div>
                    <ul class="menu menu-compact menu-horizontal p-2 rounded-box" v-else>
                        <MenuItemLink :href="route('login')" :active="route().current('login')">Login</MenuItemLink>
                        <MenuItemLink v-if="$page.props.canRegister" :href="route('register')" :active="route().current('register')">Create a new account</MenuItemLink>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Page Heading -->
        <div class="container mx-auto z-0">
            <slot name="header" />
        </div>


        <!-- Page Content -->
        <main class="z-10">
            <slot />
        </main>
    </div>

</template>
