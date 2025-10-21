<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <div class="relative">
            <input
                :id="id"
                :value="modelValue"
                @input="handleInput($event)"
                type="number"
                :min="minValue"
                :placeholder="placeholder"
                :class="[
                    'w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none',
                ]"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import { NumericInputInterface } from '@/Types/App/Interfaces/NumericInputInterface';
import { EmitInputFunctionType } from '@/Types/App/Types/EmitInputFunctionType';
import { computed, ComputedRef } from 'vue';

const {
    id,
    label,
    modelValue,
    placeholder,
    acceptNegativeNumbers = true,
}: NumericInputInterface = defineProps<NumericInputInterface>();

const emit: EmitInputFunctionType = defineEmits<EmitInputFunctionType>();

const minValue: ComputedRef<number | undefined> = computed(
    (): number | undefined => {
        return acceptNegativeNumbers ? undefined : 0;
    },
);

const handleInput = (event: Event): void => {
    const input = event.target as HTMLInputElement;
    const rawValue: string = input.value;

    if (rawValue === '') {
        emit('update:modelValue', '');
        return;
    }

    if (acceptNegativeNumbers) {
        emit('update:modelValue', rawValue);
        return;
    }

    const parsed: number = Number(rawValue);

    if (Number.isNaN(parsed)) {
        emit('update:modelValue', '');
        input.value = '';
        return;
    }

    const clamped: number = parsed < 0 ? 0 : parsed;
    const next: string = String(clamped);

    if (next !== rawValue) {
        input.value = next;
    }

    emit('update:modelValue', next);
};
</script>
