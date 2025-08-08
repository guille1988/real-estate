<template>
    <div class="relative" ref="dropdownRef">
        <button
            @click="toggleDropdown"
            class="flex w-full items-center justify-between rounded-lg bg-[#111] px-4 py-3 text-left hover:bg-[#1a1a1a]"
            :class="{ 'bg-[#1a1a1a]': isOpen }"
        >
            <div class="flex min-w-0 flex-grow items-center gap-2">
                <component
                    :is="icon"
                    class="h-6 w-6 flex-shrink-0 text-gray-500"
                />
                <span class="flex-shrink-0 whitespace-nowrap text-gray-400">{{
                    card.label
                }}</span>
                <span
                    v-if="selectedOption"
                    class="ml-2 min-w-0 max-w-full flex-grow overflow-hidden text-ellipsis whitespace-nowrap pr-2 text-purple-500"
                    >: {{ selectedOption.label }}</span
                >
            </div>
            <ChevronIcon
                :class="{ 'rotate-180': isOpen }"
                class="h-5 w-5 flex-shrink-0 text-gray-500"
                :direction="ChevronDirectionEnum.DOWN"
            />
        </button>

        <div
            v-if="isOpenDropdown()"
            class="absolute left-0 right-0 z-10 mt-1 max-h-60 overflow-auto rounded-lg border border-gray-800 bg-[#111] shadow-lg"
        >
            <ul class="py-1">
                <li
                    v-for="(option, key) in card.options"
                    :key="key"
                    @click="selectOption(option)"
                    class="flex cursor-pointer items-center px-4 py-2 text-gray-400 transition-colors duration-150 hover:bg-[#1a1a1a] hover:text-purple-500"
                    :class="{
                        'bg-[#1a1a1a] text-purple-500':
                            isOptionSelected(option),
                    }"
                >
                    <span
                        class="mr-2 h-1 w-1 rounded-full bg-purple-500"
                        v-if="isOptionSelected(option)"
                    ></span>
                    {{ option.label }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import { useIcon } from '@/Composables/useIcon';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { SearchFilterCardInterface } from '@/Types/App/Interfaces/SearchFilterCardInterface';
import { SearchFilterOptionInterface } from '@/Types/App/Interfaces/SearchFilterOptionInterface';
import { EmitSearchFilterEventsType } from '@/Types/App/Types/EmitSearchFilterEventsType';
import { EmitSearchFilterFunctionType } from '@/Types/App/Types/EmitSearchFilterFunctionType';
import {
    type Component,
    onMounted,
    onUnmounted,
    type Ref,
    ref,
    watch,
} from 'vue';

const {
    card,
    selectedValue,
}: {
    card: SearchFilterCardInterface;
    selectedValue?: string | boolean | null;
} = defineProps<{
    card: SearchFilterCardInterface;
    selectedValue?: string | boolean | null;
}>();

const emit: EmitSearchFilterFunctionType =
    defineEmits<EmitSearchFilterEventsType>();

const isOpen: Ref<boolean> = ref<boolean>(false);
const selectedOption: Ref<SearchFilterOptionInterface | null> =
    ref<SearchFilterOptionInterface | null>(null);

const icon: Component = useIcon(card.icon);

const syncSelectedFromValue = (
    value: string | boolean | null | undefined,
): void => {
    if (value === undefined) return;
    selectedOption.value =
        card.options?.find((option) => option.value === value) || null;
};

const toggleDropdown = (): void => {
    isOpen.value = !isOpen.value;
};

const selectOption = (option: SearchFilterOptionInterface): void => {
    const alreadySelected = !!isOptionSelected(option);
    selectedOption.value = alreadySelected ? null : option;
    isOpen.value = false;
    emit('optionSelected', card.id, alreadySelected ? null : option);
};

const dropdownRef: Ref<HTMLElement | null> = ref<HTMLElement | null>(null);

const shouldCloseDropdown = (event: MouseEvent): boolean | null => {
    return (
        dropdownRef.value &&
        isOpen.value &&
        !dropdownRef.value.contains(event.target as Node)
    );
};

const handleClickOutside = (event: MouseEvent): void => {
    if (shouldCloseDropdown(event)) {
        isOpen.value = false;
    }
};

const isOpenDropdown = (): boolean => {
    return isOpen.value && card.options && card.options.length > 0;
};

const isOptionSelected = (
    option: SearchFilterOptionInterface,
): boolean | null => {
    return selectedOption.value && selectedOption.value.value === option.value;
};

watch(
    (): string | boolean | null | undefined => selectedValue,
    (selectedValue: string | boolean | null | undefined): void => {
        syncSelectedFromValue(selectedValue ?? null);
    },
    { immediate: true },
);

onMounted((): void => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted((): void => {
    document.removeEventListener('click', handleClickOutside);
});
</script>
