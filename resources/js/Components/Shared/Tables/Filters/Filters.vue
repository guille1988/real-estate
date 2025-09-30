<template>
    <div class="relative inline-flex" ref="container">
        <button
            type="button"
            class="inline-flex items-center gap-2 rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-white/10 hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500"
            @click="toggle"
            :aria-expanded="isOpen ? 'true' : 'false'"
        >
            <FunnelIcon class="size-5" />
            <span>{{ label }}</span>
            <span
                v-if="activeCount > 0"
                class="ml-1 inline-flex items-center rounded-full bg-purple-500/20 px-2 py-0.5 text-xs font-medium text-purple-200 ring-1 ring-inset ring-purple-300/30"
            >
                {{ activeCount }}
            </span>
        </button>

        <div
            v-if="isOpen"
            class="fixed inset-x-4 top-20 z-20 rounded-lg border border-white/10 bg-gray-800/90 p-3 text-sm text-gray-200 shadow-xl backdrop-blur supports-[backdrop-filter]:bg-gray-800/70 sm:absolute sm:inset-auto sm:right-0 sm:top-auto sm:mt-2 sm:w-72 sm:origin-top-right"
        >
            <div class="flex items-center justify-between pb-2">
                <p class="text-xs uppercase tracking-wide text-gray-400">
                    {{ label }}
                </p>
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        class="rounded-md p-1 text-gray-300 hover:bg-white/10 hover:text-white"
                        aria-label="Close filters"
                        title="Close"
                        @click="closeDropdown"
                    >
                        <XMarkIcon class="size-4" />
                    </button>
                    <button
                        type="button"
                        class="text-xs font-medium text-purple-300 hover:text-purple-200"
                        @click="clear"
                    >
                        Clear
                    </button>
                    <button
                        type="button"
                        class="rounded-md bg-purple-600 px-2 py-1 text-xs font-semibold text-white hover:bg-purple-500"
                        @click="apply"
                    >
                        Apply
                    </button>
                </div>
            </div>

            <div
                class="max-h-[60vh] space-y-3 overflow-y-auto pr-1 sm:max-h-80"
            >
                <div v-if="Object.keys(filters).length === 0">
                    <p class="text-gray-400">No filters configured.</p>
                </div>

                <div v-else v-for="(options, name) in filters" :key="name">
                    <Filter
                        v-model="selected[name]"
                        :label="formatLabel(name)"
                        :options="options"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import Filter from '@/Components/Shared/Tables/Filters/Filter.vue';
import { FiltersInterface } from '@/Types/Admin/Interfaces/FiltersInterface';
import { EmitFilterType } from '@/Types/Admin/Types/EmitFilterType';
import { FunnelIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { router } from '@inertiajs/vue3';
import { computed, onBeforeUnmount, onMounted, Ref, ref, watch } from 'vue';

const { modelValue = false, filters } = defineProps<FiltersInterface>();

const label: string = 'Filters';
const isOpen: Ref<boolean> = ref<boolean>(modelValue);
const container: Ref<HTMLElement | null> = ref<HTMLElement | null>(null);

const selected: Ref<Record<string, boolean | number | string>> = ref({});

const activeCount = computed<number>(() => {
    return Object.values(selected.value).filter(
        (v: boolean | number | string | undefined | null) =>
            v !== '' && v !== undefined && v !== null,
    ).length;
});

const formatLabel = (name: string): string => {
    return name
        .replace(/[_-]+/g, ' ')
        .replace(/\b\w/g, (char: string): string => char.toUpperCase());
};

const emit: EmitFilterType = defineEmits<EmitFilterType>();

const toggle = (): void => {
    isOpen.value = !isOpen.value;
    emit('toggle', isOpen.value);
};

const handleClickOutside = (event: MouseEvent): void => {
    const value: HTMLElement | null = container.value;

    if (!value) {
        return;
    }

    if (isOpen.value && !value.contains(event.target as Node)) {
        isOpen.value = false;
    }
};

const apply = (): void => {
    const params: Record<string, string | number | boolean> = {};

    const isSet = (value: boolean | number | string) =>
        value !== '' && value !== undefined && value !== null;

    Object.entries(selected.value).forEach(
        ([key, value]: [string, boolean | number | string]): void => {
            if (isSet(value)) {
                params[key] = value as any;
            }
        },
    );

    router.get(window.location.pathname, params, {
        replace: true,
        preserveScroll: true,
    });

    emit('apply');
    isOpen.value = false;
};

const clear = (): void => {
    // Reset selections
    selected.value = {};

    // Clear query string via Inertia
    router.replace({ url: window.location.pathname });

    emit('clear');
    isOpen.value = false;
};

const closeDropdown = (): void => {
    isOpen.value = false;
};

watch(
    (): boolean => modelValue,
    (value: boolean): void => {
        if (value !== isOpen.value) {
            isOpen.value = value;
        }
    },
);

watch(isOpen, (value: boolean): void => {
    emit('update:modelValue', value);
});

onMounted((): void => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount((): void => {
    document.removeEventListener('click', handleClickOutside);
});
</script>
