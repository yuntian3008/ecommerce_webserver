<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:text-secondary-focus focus:outline-none focus:border-secondary-focus focus:ring focus:ring-gray-300 active:text-secondary-content active:bg-secondary disabled:opacity-25 transition">
        <slot />
    </button>
</template>
