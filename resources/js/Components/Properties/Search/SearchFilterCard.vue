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
                    class="flex-shrink-0"
                    :classes="{
                        'h-6 w-6 text-gray-500': [
                            'HouseIcon',
                            'LocalizationIcon',
                            'ChartIcon',
                        ].includes(card.icon),
                    }"
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
            <DropdownArrowIcon
                :class="{ 'rotate-180': isOpen }"
                class="flex-shrink-0"
            />
        </button>

        <div
            v-if="isOpenDropdown()"
            class="absolute left-0 right-0 z-10 mt-1 max-h-60 overflow-auto rounded-lg border border-gray-800 bg-[#111] shadow-lg"
        >
            <ul class="py-1">
                <li
                    v-for="option in card.options"
                    :key="option.id"
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
import DropdownArrowIcon from '@/Components/Icons/DropdownArrowIcon.vue';
import {
    SearchFilterCardInterface,
    SearchFilterOptionInterface,
} from '@/Types/App/Interfaces';
import {
    EmitSearchFilterEvents,
    EmitSearchFilterFunction,
} from '@/Types/App/Types';
import {
    type Component,
    type Ref,
    defineAsyncComponent,
    onMounted,
    onUnmounted,
    ref,
} from 'vue';

const { card }: { card: SearchFilterCardInterface } = defineProps<{
    card: SearchFilterCardInterface;
}>();

const emit: EmitSearchFilterFunction = defineEmits<EmitSearchFilterEvents>();

const isOpen: Ref<boolean> = ref<boolean>(false);
const selectedOption: Ref<SearchFilterOptionInterface | null> =
    ref<SearchFilterOptionInterface | null>(null);

const icon: Component = defineAsyncComponent(
    (): Promise<Component> =>
        import(`./../../Icons/${card.icon}.vue`) as Promise<Component>,
);

const toggleDropdown = (): void => {
    isOpen.value = !isOpen.value;
};

const selectOption = (option: SearchFilterOptionInterface): void => {
    selectedOption.value = option;
    isOpen.value = false;
    emit('optionSelected', card.id, option);
};

const dropdownRef = ref<HTMLElement | null>(null);

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
    return selectedOption.value && selectedOption.value.id === option.id;
};

onMounted((): void => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted((): void => {
    document.removeEventListener('click', handleClickOutside);
});
</script>
