<template>
    <div class="relative w-full">
        <span
            class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-gray-400"
        >
            <MagnifyingGlassIcon class="size-5" />
        </span>
        <input
            :value="modelValue"
            @input="onInput"
            @keydown.enter.prevent="onSubmit"
            :placeholder="placeholder"
            type="search"
            class="w-full rounded-md border border-white/10 bg-gray-900/60 py-2 pl-10 pr-9 text-sm text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none focus:ring-1 focus:ring-purple-500"
            :aria-label="ariaLabel"
        />
        <button
            v-if="isTyping"
            type="button"
            class="absolute right-2 top-1/2 -translate-y-1/2 rounded p-1 text-gray-400 hover:bg-white/10 hover:text-white"
            aria-label="Clear search"
            title="Clear"
            @click="onClear"
        >
            <XMarkIcon class="size-4" />
        </button>
    </div>
</template>

<script setup lang="ts">
import { EmitSearchBarType } from '@/Types/Admin/Types/EmitSearchBarType';
import { MagnifyingGlassIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { computed, ComputedRef } from 'vue';

const {
    modelValue = '',
    ariaLabel = 'Search',
    placeholder,
}: {
    modelValue?: string;
    ariaLabel?: string;
    placeholder: string;
} = defineProps<{
    modelValue?: string;
    ariaLabel?: string;
    placeholder: string;
}>();

const emit: EmitSearchBarType = defineEmits<EmitSearchBarType>();

const isTyping: ComputedRef<boolean> = computed(
    (): boolean => Boolean(modelValue) && String(modelValue).length > 0,
);

const onInput = (event: Event): void => {
    emit('update:modelValue', (event.target as HTMLInputElement).value);
};

const onSubmit = (): void => {
    emit('submit');
};

const onClear = (): void => {
    emit('update:modelValue', '');
    emit('clear');
};
</script>
