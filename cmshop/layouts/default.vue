<template>
  <div>
    <Navbar @sidebar="toggleSideBar"/>
    <Sidebar  :toggle="sideBar" @close="sideBar = false"/>
    <Nuxt />

  </div>


</template>

<script>
export default {
  data () {
    return {
      sideBar: false,
    }
  },
  methods: {
    toggleSideBar() {
      this.sideBar = !this.sideBar;
    }
  }
}
</script>
