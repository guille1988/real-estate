<template>
    <div
        class="rounded-lg border border-neutral-800 bg-gray-900/50 p-8 transition-all duration-300 hover:border-purple-500/50"
    >
        <h3 class="mb-4 font-bold">{{ card.title }}</h3>
        <p class="text-gray-400">{{ card.content }}</p>
    </div>
</template>

<script setup lang="ts">
import { AchievementCardInterface } from '@/Types/App/Interfaces/AchievementCardInterface';

defineProps<{
    card: AchievementCardInterface;
}>();
</script>
