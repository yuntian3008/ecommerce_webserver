<script setup>


const props = defineProps({
    src: {
        type: String,
        required: true,
    },
});

</script>

<template>
    <img :src="src" class="object-cover h-1/3 rounded-box w-full"/>

</template>
