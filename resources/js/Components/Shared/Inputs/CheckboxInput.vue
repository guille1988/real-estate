<template>
    <div>
        <label class="flex items-center">
            <input
                :id="id"
                type="checkbox"
                :checked="model_value"
                @input="handleInput($event)"
                class="mr-2 h-4 w-4 accent-purple-600"
            />
            <span class="text-sm" :class="text_class">{{ label }}</span>
        </label>
    </div>
</template>

<script setup lang="ts">
import { CheckboxInputInterface } from '@/Types/App/Interfaces/CheckboxInputInterface';
import { EmitInputFunction } from '@/Types/App/Types/EmitInputFunction';

defineProps<CheckboxInputInterface>();

const emit: EmitInputFunction = defineEmits<EmitInputFunction>();

const handleInput = (event: Event) => {
    emit('update:model_value', (event.target as HTMLInputElement).checked);
};
</script>
