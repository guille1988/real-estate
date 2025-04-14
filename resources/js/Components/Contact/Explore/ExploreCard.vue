<template>
    <div class="h-64 overflow-hidden rounded-lg sm:h-72">
        <img
            :src="card.image"
            :alt="card.alt"
            class="h-full w-full object-cover"
        />
    </div>
</template>

<script setup lang="ts">
import { ExploreCardInterface } from '@/Types/App/Interfaces';

const { card }: { card: ExploreCardInterface } = defineProps<{
    card: ExploreCardInterface;
}>();
</script>
