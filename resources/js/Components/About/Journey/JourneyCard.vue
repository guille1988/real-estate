<template>
    <div
        class="rounded-lg border border-neutral-800 bg-gray-900/50 p-6 transition-all duration-300 hover:border-purple-500/50"
    >
        <h3 class="mb-2 text-2xl font-bold md:text-4xl">
            {{ card.title }}
        </h3>
        <p class="text-gray-400">{{ card.subtitle }}</p>
    </div>
</template>
<script setup lang="ts">
import { JourneyCardInterface } from '@/Types/App/Interfaces/JourneyCardInterface';

defineProps<{
    card: JourneyCardInterface;
}>();
</script>
