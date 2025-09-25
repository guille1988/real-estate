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
            aria-label="Search"
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
import { router } from '@inertiajs/vue3';
import { computed, ComputedRef, ref, Ref, watch } from 'vue';

const {
    modelValue = '',
    placeholder,
    url,
}: {
    modelValue?: string;
    placeholder: string;
    url: string;
} = defineProps<{
    modelValue?: string;
    placeholder: string;
    url: string;
}>();

const debounceId: Ref<number | null> = ref<number | null>(null);
const emit: EmitSearchBarType = defineEmits<EmitSearchBarType>();

const isTyping: ComputedRef<boolean> = computed(
    (): boolean => Boolean(modelValue) && String(modelValue).length > 0,
);

const visit = (search: string): void => {
    const data: Record<string, string> = {};

    if (search && search.trim().length > 0) {
        data.search = search.trim();
    }

    router.get(url, data, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
};

const onInput = (event: Event): void => {
    const value = (event.target as HTMLInputElement).value;
    emit('update:modelValue', value);
};

const onSubmit = (): void => {
    if (debounceId.value) {
        clearTimeout(debounceId.value);
        debounceId.value = null;
    }
    visit(String(modelValue ?? ''));
    emit('submit');
};

const onClear = (): void => {
    emit('update:modelValue', '');
    visit('');
    emit('clear');
};

watch(
    (): string => modelValue,
    (value: string): void => {
        if (debounceId.value) {
            clearTimeout(debounceId.value);
        }
        debounceId.value = window.setTimeout(() => {
            visit(String(value ?? ''));
        }, 300);
    },
);
</script>
