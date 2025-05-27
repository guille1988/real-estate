<template>
    <div class="rounded-lg bg-gray-900/60 p-6">
        <h3 class="text-3xl font-bold">{{ card.stat }}</h3>
        <p class="text-gray-400">{{ card.description }}</p>
    </div>
</template>

<script setup lang="ts">
import { StatCardInterface } from '@/Types/App/Interfaces';

defineProps<{
    card: StatCardInterface;
}>();
</script>
