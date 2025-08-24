<template>
    <div
        class="overflow-hidden rounded-lg border border-gray-800 bg-gray-900/50 transition-all duration-300 hover:-translate-y-1 hover:border-purple-900/30 hover:shadow-lg hover:shadow-purple-900/20"
    >
        <img
            :src="card.image"
            :alt="card.name"
            class="h-64 w-full object-cover"
        />
        <div class="flex h-[120px] flex-col items-center justify-center px-0">
            <h3 class="text-center font-bold">
                {{ card.name }}
            </h3>
            <p class="text-center text-sm text-gray-400">
                {{ card.position }}
            </p>
        </div>
    </div>
</template>
<script setup lang="ts">
import { MemberCardInterface } from '@/Types/App/Interfaces/MemberCardInterface';

defineProps<{
    card: MemberCardInterface;
}>();
</script>
