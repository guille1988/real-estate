<template>
    <div class="overflow-hidden rounded-lg bg-gray-900/50">
        <img
            :src="card.image"
            :alt="card.name"
            class="h-64 w-full object-cover"
        />
        <div class="flex h-[120px] flex-col items-center justify-center px-0">
            <h3 class="text-center text-xl font-bold">
                {{ card.name }}
            </h3>
            <p class="text-center text-gray-400">
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
