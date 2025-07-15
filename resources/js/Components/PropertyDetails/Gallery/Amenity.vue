<template>
    <li class="relative bg-gray-900/40 py-3 pl-12">
        <div class="absolute bottom-0 left-0 top-0 w-1 bg-purple-600"></div>
        <div class="flex items-center gap-4">
            <ThunderIcon class="h-6 w-6 text-white" fill="currentColor" />
            <span class="text-lg text-gray-400">{{ card.description }}</span>
        </div>
    </li>
</template>

<script setup lang="ts">
import ThunderIcon from '@/Components/Icons/ThunderIcon.vue';
import { AmenityInterface } from '@/Types/App/Interfaces/AmenityInterface';

const { card }: { card: AmenityInterface } = defineProps<{
    card: AmenityInterface;
}>();
</script>
