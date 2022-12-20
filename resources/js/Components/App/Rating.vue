<script setup>
import { computed, ref } from '@vue/reactivity';
import { watch } from '@vue/runtime-core';

const props = defineProps({
    rate: {
        type: Number,
        default: 0.5
    },
    ratingSize: {
        type: String,
    },
    enabled: {
        type: Boolean,
        default: false,
    }
})


const emit = defineEmits(['v-rate'])

const rate = ref(props.rate)

const currentRating = computed(() => {
    return Math.round(props.rate*2) / 2 ;
});

watch(rate, (newRate, oldRate) => {
      emit('v-rate',newRate)
    });



</script>

<template>
    <div class="rating rating-half" :class="'rating rating-half ' + (ratingSize ?? 'rating-md')">
        <input v-for="n in 10" :key="n" :checked="n == currentRating * 2" type="radio" name="rating-10" :class="'bg-orange-400 mask mask-star-2 mask-half-' + ((n % 2 == 0) ? 2 : 1)" :value="n / 2" v-model="rate" :disabled="!enabled"/>
    </div>
</template>
