<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <div class="relative">
            <select
                :id="id"
                :value="getDisplayValue()"
                @input="handleInput($event)"
                class="w-full appearance-none rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
            >
                <option value="" disabled selected>{{ placeholder }}</option>
                <option
                    v-for="(value, key) in options"
                    :key="`${id}-option-${key}`"
                    :value="key"
                >
                    {{ value }}
                </option>
            </select>
        </div>
    </div>
</template>

<script setup lang="ts">
import { DropdownInputInterface } from '@/Types/App/Interfaces';
import { EmitInputFunction } from '@/Types/App/Types';

const dropdown: DropdownInputInterface = defineProps<DropdownInputInterface>();

const emit: EmitInputFunction = defineEmits<EmitInputFunction>();

const getDisplayValue = (): string => {
    return !dropdown.model_value ? '' : dropdown.model_value.toString();
};

const handleInput = (event: Event) => {
    emit('update:model_value', (event.target as HTMLSelectElement).value);
};
</script>
