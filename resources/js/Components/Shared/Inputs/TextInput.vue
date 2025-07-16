<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <input
            :id="id"
            :value="modelValue"
            @input="handleInput($event)"
            :type="type"
            :placeholder="placeholder"
            class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
        />
    </div>
</template>

<script setup lang="ts">
import { TextInputInterface } from '@/Types/App/Interfaces/TextInputInterface';
import { EmitInputFunctionType } from '@/Types/App/Types/EmitInputFunctionType';

defineProps<TextInputInterface>();

const emit: EmitInputFunctionType = defineEmits<EmitInputFunctionType>();

const handleInput = (event: Event): void => {
    emit('update:modelValue', (event.target as HTMLInputElement).value);
};
</script>
