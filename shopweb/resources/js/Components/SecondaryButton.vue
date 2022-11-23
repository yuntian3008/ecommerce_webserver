<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:text-orange-500-focus focus:outline-none focus:border-orange-500-focus focus:ring focus:ring-gray-300 active:text-orange-500-content active:bg-orange-500 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
