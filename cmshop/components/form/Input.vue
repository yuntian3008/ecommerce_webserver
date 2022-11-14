<template>
  <div class="w-full">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ label }}</label>
    <textarea v-if="textarea" rows="5" :value="value" @input="$emit('input', $event.target.value)"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                :placeholder="placeholder ?? label"></textarea>

    <div v-else class="relative">
      <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">

        <slot name="icon" :_class="'w-5 h-5 text-gray-500 dark:text-gray-400'"></slot>

      </div>
      <input type="text" :value="value" @input="$emit('input', $event.target.value)"
        :class="($scopedSlots.icon ? 'pl-10 ' : '') + 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'"
        :placeholder="placeholder ?? label" required>
    </div>
    <p id="helper-text-explanation" v-if="$scopedSlots.helper" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
      <slot name="helper"></slot>
    </p>
  </div>
</template>

<script>
export default {
  name: 'FormInput',
  props: {
    label: {
      type: String,
      required: true,
    },
    placeholder: {
      type: String,
    },
    value: [String, Number, Boolean],
    textarea: {
      type: Boolean,
      default() {
        return false
      },
    }

  },
  data () {
    return {
      scopedSlots: this.$scopedSlots,
      slot: this.$slots
    }
  }
}
</script>
