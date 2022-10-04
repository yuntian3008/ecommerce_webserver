<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
    isButton: {
        type: Boolean,
        default: false,
    },
});

const classes = computed(() => {
    return props.active
        ? 'active'
        : '';
});

</script>

<template>
    <li>
        <button v-if="isButton" type="submit" :class="classes">
            <slot/>
        </button>
        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </li>

</template>
