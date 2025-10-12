<template>
    <div class="relative w-full">
        <span
            class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-gray-400"
        >
            <MagnifyingGlassIcon class="size-5" />
        </span>
        <input
            :value="searchValue"
            @input="onInput"
            @keydown.enter.prevent="onSubmit"
            :placeholder="placeholderText"
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
import { MagnifyingGlassIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { Page } from '@inertiajs/core';
import { router, usePage } from '@inertiajs/vue3';
import { computed, ComputedRef, onMounted, ref, Ref, watch } from 'vue';

const page: Page = usePage();
const placeholderText: string = 'Search...';
const searchValue: Ref<string> = ref<string>('');
const debounceId: Ref<number | null> = ref<number | null>(null);

const isTyping: ComputedRef<boolean> = computed(
    (): boolean => Boolean(searchValue.value) && searchValue.value.length > 0,
);

const readFromQuery = (): void => {
    const url: string = page.url as unknown as string;
    const query: string = url.includes('?') ? url.split('?')[1] : '';
    const params: URLSearchParams = new URLSearchParams(query);
    const raw: string | null = params.get('search');
    searchValue.value = raw ?? '';
};

const visit = (search: string): void => {
    const urlParams: URLSearchParams = new URLSearchParams(
        window.location.search,
    );

    if (search && search.trim().length > 0) {
        urlParams.set('search', search.trim());
    } else {
        urlParams.delete('search');
    }

    const mergedParams: Record<string, string> = {};

    urlParams.forEach((value: string, key: string): void => {
        mergedParams[key] = value;
    });

    router.get(window.location.pathname, mergedParams, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
};

const onInput = (event: Event): void => {
    searchValue.value = (event.target as HTMLInputElement).value;
};

const onSubmit = (): void => {
    if (debounceId.value) {
        clearTimeout(debounceId.value);
        debounceId.value = null;
    }
    visit(String(searchValue.value ?? ''));
};

const onClear = (): void => {
    searchValue.value = '';
    visit('');
};

watch(
    (): string => searchValue.value,
    (value: string): void => {
        if (debounceId.value) {
            clearTimeout(debounceId.value);
        }
        debounceId.value = window.setTimeout((): void => {
            visit(String(value ?? ''));
        }, 300);
    },
);

watch(
    (): string => page.url,
    (): void => {
        readFromQuery();
    },
);

onMounted((): void => {
    readFromQuery();
});
</script>
