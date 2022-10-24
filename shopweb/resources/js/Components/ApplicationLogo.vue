<script setup>

defineProps({
    width : String,
    height : String,
})

</script>

<template>
    <img :class="'w-'+ width + ' h-' + height + ' bg-white rounded-full'" src="http://localhost:8000/dev_assets/logo-transparent.png" alt="logo"/>
</template>
