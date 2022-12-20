<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500-focus active:bg-primary-500 focus:outline-none focus:border-primary-500-focus focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
