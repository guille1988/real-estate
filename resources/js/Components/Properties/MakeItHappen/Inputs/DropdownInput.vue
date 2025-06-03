<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <div class="relative">
            <select
                :id="id"
                :value="modelValue"
                @input="
                    $emit(
                        'update:modelValue',
                        ($event.target as HTMLSelectElement).value,
                    )
                "
                class="w-full appearance-none rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
            >
                <option value="" disabled selected>{{ placeholder }}</option>
                <option
                    v-for="(option, index) in options"
                    :key="`${id}-option-${index}`"
                    :value="
                        typeof option === 'object' &&
                        option !== null &&
                        'value' in option
                            ? option.value
                            : option
                    "
                >
                    {{
                        typeof option === 'object' &&
                        option !== null &&
                        'label' in option
                            ? option.label
                            : option
                    }}
                </option>
            </select>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2"
            >
                <svg
                    class="h-4 w-4 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    ></path>
                </svg>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { PropType } from 'vue';

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
        type: [String, Number],
        required: true,
    },
    placeholder: {
        type: String,
        default: 'Select an option',
    },
    options: {
        type: Array as PropType<
            Array<{ value?: string | number; label?: string } | string | number>
        >,
        required: true,
    },
});

defineEmits(['update:modelValue']);
</script>
