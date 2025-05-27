<template>
    <div class="relative rounded-lg bg-gray-900/60 p-6">
        <div class="mb-12 flex items-start justify-between">
            <div
                class="flex h-12 w-12 items-center justify-center rounded-full border border-purple-600 bg-black/60"
            >
                <component :is="icon" />
            </div>
            <RightArrowIcon />
        </div>
        <h3 class="font-medium">{{ card.description }}</h3>
    </div>
</template>

<script setup lang="ts">
import RightArrowIcon from '@/Components/Home/HeroSection/HeroSectionCard/Icons/RightArrowIcon.vue';
import { HeroSectionCardInterface } from '@/Types/App/Interfaces';
import { defineAsyncComponent, type Component } from 'vue';

const { card }: { card: HeroSectionCardInterface } = defineProps<{
    card: HeroSectionCardInterface;
}>();

const icon: Component = defineAsyncComponent(
    (): Promise<Component> =>
        import(`./Icons/${card.icon}.vue`) as Promise<Component>,
);
</script>
