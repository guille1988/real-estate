<template>
    <div>
        <label class="flex items-center">
            <input
                :id="id"
                type="checkbox"
                :checked="modelValue"
                @input="handleInput($event)"
                class="mr-2 h-4 w-4 accent-purple-600"
            />
            <span class="text-sm" :class="textClass">{{ label }}</span>
        </label>
    </div>
</template>

<script setup lang="ts">
import { CheckboxInputInterface } from '@/Types/App/Interfaces/CheckboxInputInterface';
import { EmitInputFunctionType } from '@/Types/App/Types/EmitInputFunctionType';

defineProps<CheckboxInputInterface>();

const emit: EmitInputFunctionType = defineEmits<EmitInputFunctionType>();

const handleInput = (event: Event) => {
    emit('update:modelValue', (event.target as HTMLInputElement).checked);
};
</script>
