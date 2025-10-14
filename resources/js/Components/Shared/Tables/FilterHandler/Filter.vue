<template>
    <div>
        <label class="block text-xs text-gray-400">{{ label }}</label>
        <select
            class="mt-1 w-full rounded-md border border-white/10 bg-gray-900/60 px-2 py-1.5 text-sm text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none focus:ring-purple-500"
            :value="modelValue"
            @change="onChange"
        >
            <option value="">-</option>
            <option
                v-for="option in options"
                :key="option.label"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>
    </div>
</template>

<script setup lang="ts">
import { EmitSelectFilterType } from '@/Types/Admin/Types/EmitSelectFilterType';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';

const {
    modelValue,
    label,
    options,
}: {
    modelValue: boolean | number | string;
    label: string;
    options: SelectFilterOptionType[];
} = defineProps<{
    modelValue: boolean | number | string;
    label: string;
    options: SelectFilterOptionType[];
}>();

const emit: EmitSelectFilterType = defineEmits<EmitSelectFilterType>();

const onChange = (event: Event): void => {
    const target = event.target as HTMLSelectElement;
    const value = target.value;

    const match = options.find(
        (option: SelectFilterOptionType): boolean =>
            String(option.value) === value,
    );

    emit('update:modelValue', match ? (match.value as any) : value);
};
</script>
