<template>
    <div
        class="relative rounded-lg border border-neutral-800 bg-gray-900/50 p-8 transition-all duration-300 hover:border-purple-500/50"
    >
        <div class="absolute left-0 top-0 h-1 w-16 bg-purple-600"></div>
        <span class="mb-4 block text-sm text-gray-400"
            >Step {{ getStep() }}</span
        >
        <h3 class="mb-4 font-bold">{{ card.title }}</h3>
        <p class="text-gray-400">{{ card.description }}</p>
    </div>
</template>

<script setup lang="ts">
import { NavigatingExperienceCardInterface } from '@/Types/App/Interfaces/NavigatingExperienceCardInterface';

const { card }: { card: NavigatingExperienceCardInterface } = defineProps<{
    card: NavigatingExperienceCardInterface;
}>();

const getStep = (): string => (card.id < 10 ? '0' + card.id : String(card.id));
</script>
