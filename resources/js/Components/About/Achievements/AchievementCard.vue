<template>
    <div class="rounded-lg bg-gray-900/50 p-8">
        <h3 class="mb-4 text-2xl font-bold">{{ card.title }}</h3>
        <p class="text-gray-400">{{ card.content }}</p>
    </div>
</template>

<script setup lang="ts">
import { AchievementCardInterface } from '@/Types/Interfaces';

defineProps<{
    card: AchievementCardInterface;
}>();
</script>
