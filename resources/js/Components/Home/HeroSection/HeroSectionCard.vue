<template>
    <div
        class="relative cursor-pointer rounded-lg border border-transparent bg-gray-900/60 p-6 transition-all duration-300 hover:border-purple-600"
        @click="visit(card.url)"
    >
        <div class="mb-12 flex items-start justify-between">
            <div
                class="flex h-12 w-12 items-center justify-center rounded-full border border-purple-600 bg-black/60"
            >
                <component
                    :is="icon"
                    :classes="{
                        'h-6 w-6 text-gray-800 text-purple-500':
                            card.icon === 'BuildingIcon',
                    }"
                />
            </div>
            <RightArrowIcon />
        </div>
        <h3 class="font-medium">{{ card.description }}</h3>
    </div>
</template>

<script setup lang="ts">
import RightArrowIcon from '@/Components/Icons/RightArrowIcon.vue';
import { HeroSectionCardInterface } from '@/Types/App/Interfaces';
import { router } from '@inertiajs/vue3';
import { defineAsyncComponent, type Component } from 'vue';

const { card }: { card: HeroSectionCardInterface } = defineProps<{
    card: HeroSectionCardInterface;
}>();

const icon: Component = defineAsyncComponent(
    (): Promise<Component> =>
        import(`./../../Icons/${card.icon}.vue`) as Promise<Component>,
);

const visit = (url: string): void => {
    router.visit(url);
};
</script>
