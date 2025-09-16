<template>
    <div>
        <label :for="id" class="mb-2 block text-sm">{{ label }}</label>
        <div class="relative">
            <input
                :id="id"
                :value="modelValue"
                @input="handleInput($event)"
                :type="currentType"
                :placeholder="placeholder"
                :class="[
                    'w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none',
                    isPassword ? 'pr-10' : '',
                ]"
            />

            <button
                v-if="isPassword"
                type="button"
                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 focus:outline-none"
                :aria-label="getLabel"
                :title="getLabel"
                @click="togglePasswordVisibility"
            >
                <PasswordIcon :show-password="showPassword" />
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import PasswordIcon from '@/Components/Icons/PasswordIcon.vue';
import { TextInputInterface } from '@/Types/App/Interfaces/TextInputInterface';
import { EmitInputFunctionType } from '@/Types/App/Types/EmitInputFunctionType';
import { computed, ComputedRef, ref } from 'vue';

const {
    id,
    label,
    modelValue,
    type,
    placeholder,
}: {
    id: string;
    label: string;
    modelValue: string;
    type: string;
    placeholder: string;
} = defineProps<TextInputInterface>();

const emit: EmitInputFunctionType = defineEmits<EmitInputFunctionType>();

const showPassword = ref<boolean>(false);
const getLabel: ComputedRef<string> = computed((): string => {
    const action: string = showPassword.value ? 'Hide' : 'Show';

    return `${action} password`;
});
const isPassword: ComputedRef<boolean> = computed<boolean>(
    (): boolean => type === 'password',
);
const currentType: ComputedRef<string> = computed<string>((): string =>
    isPassword.value && showPassword.value ? 'text' : type,
);

const togglePasswordVisibility = (): void => {
    if (!isPassword.value) {
        return;
    }
    showPassword.value = !showPassword.value;
};

const handleInput = (event: Event): void => {
    emit('update:modelValue', (event.target as HTMLInputElement).value);
};
</script>
