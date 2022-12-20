<script setup>

defineProps({
    width : String,
    height : String,
})

</script>

<template>
    <img :class="'w-'+ width + ' h-' + height + ' bg-white rounded-full'" src="https://mms.cielot.com/dev_assets/logo-transparent.png" alt="logo"/>
</template>
