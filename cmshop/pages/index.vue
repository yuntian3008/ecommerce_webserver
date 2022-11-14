<template>
  <div class="container mx-auto">
    <FormInput label="Email" placeholder="abcabc.com" v-model="value">
      <template v-slot:icon="{ _class}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="_class">
          <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
        </svg>

      </template>
      <template v-slot:helper>
        We’ll never share your details. Read our <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Privacy Policy</a>
      </template>

    </FormInput>

    <!-- <Modal :show="showModal" :type="'warning'" title="Thành công" @close="showModal = false" @action="showModal = false"/> -->
  </div>

</template>

<script>
export default {
  name: 'IndexPage',
  data: function () {
    return {
      showModal: true,
      value: "",
    }
  },
  methods: {

  },

}
</script>
