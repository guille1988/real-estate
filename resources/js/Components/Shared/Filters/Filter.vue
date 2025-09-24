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
                v-if="count > 0"
                class="ml-1 inline-flex items-center rounded-full bg-purple-500/20 px-2 py-0.5 text-xs font-medium text-purple-200 ring-1 ring-inset ring-purple-300/30"
            >
                {{ count }}
            </span>
        </button>

        <div
            v-if="isOpen"
            class="absolute right-0 z-20 mt-2 w-72 origin-top-right rounded-lg border border-white/10 bg-gray-800/90 p-3 text-sm text-gray-200 shadow-xl backdrop-blur supports-[backdrop-filter]:bg-gray-800/70"
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
                        v-if="showClear"
                        type="button"
                        class="text-xs font-medium text-purple-300 hover:text-purple-200"
                        @click="$emit('clear')"
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

            <div class="max-h-80 space-y-3 overflow-y-auto pr-1">
                <slot>
                    <p class="text-gray-400">No filters configured.</p>
                </slot>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { FilterInterface } from '@/Types/Admin/Interfaces/FilterInterface';
import { EmitFilterType } from '@/Types/Admin/Types/EmitFilterType';
import { FunnelIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { onBeforeUnmount, onMounted, Ref, ref, watch } from 'vue';

const {
    modelValue = false,
    count = 0,
    showClear = true,
}: {
    modelValue?: boolean;
    count?: number;
    showClear?: boolean;
} = defineProps<FilterInterface>();

const label: string = 'Filters';
const isOpen: Ref<boolean> = ref<boolean>(modelValue);
const container: Ref<HTMLElement | null> = ref<HTMLElement | null>(null);

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
    emit('apply');
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
