<template>
    <div>
        <label class="flex items-center">
            <input
                :id="id"
                type="checkbox"
                :checked="modelValue"
                @input="
                    $emit(
                        'update:modelValue',
                        ($event.target as HTMLInputElement).checked,
                    )
                "
                class="mr-2 h-4 w-4 accent-purple-600"
            />
            <span class="text-sm" :class="textClass">{{ label }}</span>
        </label>
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
        type: Boolean,
        required: true,
    },
    textClass: {
        type: String,
        default: 'text-gray-400',
    },
});

defineEmits(['update:modelValue']);
</script>
