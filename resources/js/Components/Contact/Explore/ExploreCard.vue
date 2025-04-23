<template>
    <div :class="getClass()">
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

const getClass = (): string =>
    'overflow-hidden rounded-lg' + (card.is_split ? 'h-64 sm:h-72' : 'flex-1');
</script>
