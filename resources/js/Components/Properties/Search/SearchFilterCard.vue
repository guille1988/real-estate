<template>
    <div class="relative" ref="dropdownRef">
        <button
            @click="toggleDropdown"
            class="flex w-full items-center justify-between rounded-lg bg-[#111] px-4 py-3 text-left hover:bg-[#1a1a1a]"
            :class="{ 'bg-[#1a1a1a]': isOpen }"
        >
            <div class="flex items-center gap-2">
                <component :is="icon" />
                <span class="text-gray-400">{{ card.label }}</span>
                <span v-if="selectedOption" class="ml-2 text-purple-500"
                    >: {{ selectedOption.label }}</span
                >
            </div>
            <DropdownArrowIcon :class="{ 'rotate-180': isOpen }" />
        </button>

        <div
            v-if="isOpen && card.options && card.options.length > 0"
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
                            selectedOption && selectedOption.id === option.id,
                    }"
                >
                    <span
                        class="mr-2 h-1 w-1 rounded-full bg-purple-500"
                        v-if="selectedOption && selectedOption.id === option.id"
                    ></span>
                    {{ option.label }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import DropdownArrowIcon from '@/Components/Properties/Search/Icons/DropdownArrowIcon.vue';
import {
    SearchFilterCardInterface,
    SearchFilterOptionInterface,
} from '@/Types/App/Interfaces';
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

type EmitEvents = {
    optionSelected: [cardId: number, option: SearchFilterOptionInterface];
};

type EmitFunction = {
    <T extends keyof EmitEvents>(event: T, ...args: EmitEvents[T]): void;
};

const emit: EmitFunction = defineEmits<EmitEvents>();

const isOpen: Ref<boolean> = ref<boolean>(false);
const selectedOption: Ref<SearchFilterOptionInterface | null> =
    ref<SearchFilterOptionInterface | null>(null);

const icon: Component = defineAsyncComponent(
    (): Promise<Component> =>
        import(`./Icons/${card.icon}.vue`) as Promise<Component>,
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

onMounted((): void => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted((): void => {
    document.removeEventListener('click', handleClickOutside);
});
</script>
