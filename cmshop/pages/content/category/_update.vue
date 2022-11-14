<template>
  <div class="container mx-auto px-4 lg:px-0">
    <Modal :show="state.success" :type="'success'" title="Thành công" @close="$router.push('/content/category')"
      @action="$router.push('/content/category')" />
    <ConfirmModal :loadingState="true" :show="state.confirm" question="Bạn có chắc muốn xóa danh mục này?" @close="state.confirm = false" @action="del"/>

    <h1 class="text-4xl font-extrabold dark:text-white  mb-8">Danh mục</h1>
    <section class="bg-white dark:bg-gray-900">
      <div class="max-w-2xl px-4 mx-auto py-8">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Cập nhật danh mục</h2>
        <form action="#">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
              <FormInput label="Tên danh mục" :placeholder="category.name" v-model="category.name" />
            </div>
            <div class="sm:col-span-2">
              <FormInput label="Mô tả" :placeholder="category.desc ?? '<trống>'" :textarea="true"
                v-model="category.desc" />
            </div>
          </div>
          <div class="flex justify-between items-center">
            <NuxtLink to="/content/category"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="mr-2 -ml-1 w-5 h-5">
                <path fill-rule="evenodd"
                  d="M7.793 2.232a.75.75 0 01-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 010 10.75H10.75a.75.75 0 010-1.5h2.875a3.875 3.875 0 000-7.75H3.622l4.146 3.957a.75.75 0 01-1.036 1.085l-5.5-5.25a.75.75 0 010-1.085l5.5-5.25a.75.75 0 011.06.025z"
                  clip-rule="evenodd" />
              </svg>
              Trở về
            </NuxtLink>
            <div class="flex items-center space-x-4">
              <button type="button" @click.prevent="submit"
                class="inline-flex item-centers text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg v-if="state.loading" class="animate-twSpin animate-infinite -ml-1 mr-3 h-5 w-5 text-white"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                  </path>
                </svg>
                Cập nhật
              </button>
              <button type="button" @click.prevent="state.confirm = true"
                class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
                </svg>
                Xóa
              </button>
            </div>

          </div>
        </form>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'ContentCategoryUpdate',
  transition: {
    enterActiveClass: 'animate-fadeIn',
  },
  data() {
    return {
      state: {
        loading: false,
        success: false,
        confirm: false,
        loadingConfirm: false,
      },
    }
  },
  // computed: {
  //   changed() {
  //     const obj = this.newCategory;
  //     Object.keys(obj).forEach((k) => (obj[k] === null || obj[k] === undefined || obj[k] === '') && delete obj[k]);
  //     return obj;
  //   }
  // },
  async asyncData({ params, $axios }) {
    const category = await $axios.get('/content/categories/' + params.update)
    return { category: category.data }
  },
  methods: {
    async submit() {
      let app = this;
      try {
        this.state.loading = true
        const result = await this.$axios.patch('/content/categories/' + this.category.id, this.category)
        this.state = {
          loading: false,
          success: true,
        }
      } catch (e) {
        this.state.loading = false
        if (!e.response) {
          app.$toast.global.myError()

        }
        else
          switch (e.response.status) {
            case 422:
              Object.entries(e.response.data.errors).forEach(([key, value]) => {
                app.$toast.global.myError({
                  message: `${value}`
                })
              })
              break;


            default:
              app.$toast.global.myError()
              break;
          }
      }

    },
    async del (callback) {
      try {
        const result = await this.$axios.delete('/content/categories/' + this.category.id)
        callback()
        this.state.success = true
      } catch (e) {
        this.$toast.global.myError()
      }
    }
  }

}
</script>
