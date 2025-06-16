<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <textarea
            :id="id"
            :value="model_value"
            @input="handleInput($event)"
            :rows="rows"
            :placeholder="placeholder"
            class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
        ></textarea>
    </div>
</template>

<script setup lang="ts">
import { TextareaInputInterface } from '@/Types/App/Interfaces/TextareaInputInterface';
import { EmitInputFunctionType } from '@/Types/App/Types/EmitInputFunctionType';

defineProps<TextareaInputInterface>();

const emit: EmitInputFunctionType = defineEmits<EmitInputFunctionType>();

const handleInput = (event: Event) => {
    emit('update:model_value', (event.target as HTMLTextAreaElement).value);
};
</script>
