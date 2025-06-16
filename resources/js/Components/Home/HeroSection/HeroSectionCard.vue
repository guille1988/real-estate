<template>
    <div
        class="relative cursor-pointer rounded-lg border border-transparent bg-gray-900/60 p-6 transition-all duration-300 hover:border-purple-600"
        @click="visit(card.url)"
    >
        <div class="mb-12 flex items-start justify-between">
            <div
                class="flex h-12 w-12 items-center justify-center rounded-full border border-purple-600 bg-black/60"
            >
                <component :is="icon" class="h-6 w-6 text-purple-500" />
            </div>
            <ArrowIcon class="h-5 w-5" :direction="ArrowDirectionEnum.RIGHT" />
        </div>
        <h3 class="font-medium">{{ card.description }}</h3>
    </div>
</template>

<script setup lang="ts">
import ArrowIcon from '@/Components/Icons/ArrowIcon.vue';
import { useIcon } from '@/Composables/useIcon';
import { ArrowDirectionEnum } from '@/Types/App/Enums/ArrowDirectionEnum';
import { HeroSectionCardInterface } from '@/Types/App/Interfaces/HeroSectionCardInterface';
import { router } from '@inertiajs/vue3';
import { type Component } from 'vue';

const { card }: { card: HeroSectionCardInterface } = defineProps<{
    card: HeroSectionCardInterface;
}>();

const icon: Component = useIcon(card.icon);

const visit = (url: string): void => {
    router.visit(url);
};
</script>
