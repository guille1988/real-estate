<template>
    <div class="rounded-lg bg-gray-900/50 p-4 text-center">
        <div class="mb-2 flex items-center justify-center">
            <component :is="card.icon" class="h-6 w-6 text-white" />
        </div>
        <div class="text-sm text-gray-400">{{ card.title }}</div>
        <div class="font-semibold">{{ card.description }}</div>
    </div>
</template>
<script setup lang="ts">
import { DescriptionInterface } from '@/Types/App/Interfaces/DescriptionInterface';

const { card }: { card: DescriptionInterface } = defineProps<{
    card: DescriptionInterface;
}>();
</script>
