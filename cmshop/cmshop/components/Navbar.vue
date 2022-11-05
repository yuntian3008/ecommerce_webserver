<template>
  <header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
      <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
          <button id="toggleSidebar" aria-expanded="true" aria-controls="sidebar"
            class="hidden p-2 mr-3 text-gray-600 rounded cursor-pointer lg:inline hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"></path>
            </svg>
          </button>
          <button aria-expanded="true" aria-controls="sidebar"
            class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Toggle sidebar</span>
          </button>
          <a href="https://flowbite.com" class="flex mr-4">
            <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="mr-3 h-8" alt="FlowBite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
          </a>
          <!-- <form action="#" method="GET" class="hidden lg:block lg:pl-2">
            <label for="topbar-search" class="sr-only">Search</label>
            <div class="relative mt-1 lg:w-96">
              <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
                </svg>
              </div>
              <input type="text" name="email" id="topbar-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Search">
            </div>
          </form> -->
        </div>
        <div class="flex items-center lg:order-2">
          <button type="button"
            class="hidden sm:inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"><svg
              aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"></path>
            </svg> New Widget</button>
          <!-- <button id="toggleSidebarMobileSearch" type="button"
            class="p-2 text-gray-500 rounded-lg lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <span class="sr-only">Search</span>
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd"></path>
            </svg>
          </button> -->
          <!-- Notifications -->

          <div class="relative">
            <button type="button" @click="toggleAvatar"
              class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
              id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <transition name="avatar">
              <div v-if="avatarDropdown" v-click-outside="clickOutAvatarDropdown"
                class="absolute right-0 rounded-xl top-8 z-50 my-4 w-56 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                id="dropdown">
                <div class="py-3 px-4">
                  <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ $auth.user.name }}</span>
                  <span
                    class="block text-sm font-light text-gray-500 truncate dark:text-gray-400">{{ $auth.user.email }}</span>
                </div>
                <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                  <li>
                    <a href="#"
                      class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My
                      profile</a>
                  </li>
                  <li>
                    <a href="#"
                      class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Account
                      settings</a>
                  </li>
                </ul>
                <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                  <li>
                    <a href="#"
                      class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                        class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                          clip-rule="evenodd"></path>
                      </svg> My likes</a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                        class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                        </path>
                      </svg> Collections</a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex justify-between items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                      <span class="flex items-center">
                        <svg aria-hidden="true" class="mr-2 w-5 h-5 text-primary-600 dark:text-primary-500"
                          fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd"
                            d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                            clip-rule="evenodd"></path>
                        </svg> Pro version
                      </span>
                      <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"></path>
                      </svg>
                    </a>
                  </li>

                </ul>
                <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                  <li>
                    <a @click="logout"
                      class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Đăng xuất</a>
                  </li>
                </ul>
              </div>
            </transition>

          </div>

        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import 'flowbite'

export default {
  name: 'Navbar',
  transitions: {
    name: 'avatar'
  },
  data() {
    return {
      avatarDropdown: false,
      user : this.$auth.user,
    }
  },
  methods: {
    toggleAvatar() {
      this.avatarDropdown = !this.avatarDropdown
    },
    clickOutAvatarDropdown() {
      this.avatarDropdown = false;
    },
    async logout() {
      await this.$auth.logout()
      this.$toast.global.success({
          message: 'Đã đăng xuất'
        })
      this.$router.push('/login')
    }
  }
}
</script>


<style>
.avatar-enter-active {
  animation: zoomIn 0.3s;
}

.avatar-leave-active {
  animation: zoomOut 0.3s;
}
</style>
