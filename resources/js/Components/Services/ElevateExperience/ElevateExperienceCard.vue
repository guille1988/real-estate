<template>
    <div
        class="group relative border border-neutral-800 bg-neutral-900/30 p-6 transition-colors duration-300 hover:border-purple-500/50"
        @click="visit(card.url)"
    >
        <div class="absolute right-4 top-4">
            <RightArrowIcon
                class="h-5 w-5 text-gray-600 transition-colors duration-300 group-hover:text-purple-500"
            />
        </div>

        <div class="flex flex-col items-center">
            <div
                class="mb-8 flex h-14 w-14 items-center justify-center rounded-full bg-purple-500/10"
            >
                <component
                    :is="icon"
                    :classes="{
                        'h-6 w-6 text-gray-800 text-purple-500':
                            card.icon === 'BuildingIcon',
                        'h-6 w-6 text-purple-500': card.icon === 'HouseIcon',
                    }"
                />
            </div>
            <h3 class="text-center text-lg font-medium">
                {{ card.description }}
            </h3>
        </div>
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
