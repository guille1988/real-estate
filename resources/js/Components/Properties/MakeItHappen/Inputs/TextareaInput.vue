<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <textarea
            :id="id"
            :value="modelValue"
            @input="
                $emit(
                    'update:modelValue',
                    ($event.target as HTMLTextAreaElement).value,
                )
            "
            :rows="rows"
            :placeholder="placeholder"
            class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
        ></textarea>
    </div>
</template>

<script setup lang="ts">
defineProps({
    id: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    modelValue: {
        type: String,
        required: true,
    },
    rows: {
        type: Number,
        default: 5,
    },
    placeholder: {
        type: String,
        default: '',
    },
});

defineEmits(['update:modelValue']);
</script>
