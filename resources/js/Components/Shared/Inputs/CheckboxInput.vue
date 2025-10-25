<template>
    <div>
        <!-- Default checkbox -->
        <label v-if="!icon" class="flex items-center">
            <input
                :id="id"
                type="checkbox"
                :checked="modelValue"
                @input="handleInput($event)"
                class="mr-2 h-4 w-4 accent-purple-600"
            />
            <span class="text-sm" :class="textClass">{{ label }}</span>
        </label>

        <!-- Toggle icon style -->
        <label
            v-else
            class="ml-2 flex cursor-pointer select-none items-center gap-2"
        >
            <input
                :id="id"
                type="checkbox"
                :checked="modelValue"
                @input="handleInput($event)"
                class="peer sr-only"
            />
            <span
                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-purple-400"
                :class="modelValue ? 'bg-purple-600' : 'bg-gray-600'"
                aria-hidden="true"
            >
                <span
                    class="absolute left-1 h-4 w-4 rounded-full bg-white transition-transform duration-200"
                    :class="modelValue ? 'translate-x-5' : 'translate-x-0'"
                ></span>
            </span>
            <span :class="textClass">{{ label }}</span>
        </label>
    </div>
</template>

<script setup lang="ts">
import { CheckboxInputInterface } from '@/Types/App/Interfaces/CheckboxInputInterface';
import { EmitInputFunctionType } from '@/Types/App/Types/EmitInputFunctionType';

const {
    id,
    label,
    modelValue,
    textClass,
    icon = false,
} = defineProps<CheckboxInputInterface>();

const emit: EmitInputFunctionType = defineEmits<EmitInputFunctionType>();

const handleInput = (event: Event): void => {
    emit('update:modelValue', (event.target as HTMLInputElement).checked);
};
</script>
