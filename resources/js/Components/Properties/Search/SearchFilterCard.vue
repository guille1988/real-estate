<template>
    <button
        class="flex items-center justify-between rounded-lg bg-[#111] px-4 py-3 text-left text-gray-400 hover:bg-[#1a1a1a]"
    >
        <div class="flex items-center gap-2">
            <component :is="icon" />
            {{ card.label }}
        </div>
        <DropdownArrowIcon />
    </button>
</template>

<script setup lang="ts">
import DropdownArrowIcon from '@/Components/Properties/Search/Icons/DropdownArrowIcon.vue';
import { SearchFilterCardInterface } from '@/Types/App/Interfaces';
import { type Component, defineAsyncComponent } from 'vue';

const { card }: { card: SearchFilterCardInterface } = defineProps<{
    card: SearchFilterCardInterface;
}>();

const icon: Component = defineAsyncComponent(
    (): Promise<Component> =>
        import(`./Icons/${card.icon}.vue`) as Promise<Component>,
);
</script>
