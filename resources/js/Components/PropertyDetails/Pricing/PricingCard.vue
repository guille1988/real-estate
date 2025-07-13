<template>
    <div class="border border-neutral-700 p-6">
        <div class="mb-6 flex items-center justify-between">
            <h4 class="text-lg font-medium">{{ card.subject }}</h4>
        </div>

        <div class="space-y-6">
            <PricingDetailCard
                v-for="(detail, detailIndex) in card.details"
                :key="detailIndex"
                :detail="detail"
                :hasBorder="hasBorder(detailIndex)"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import { PricingCardInterface } from '@/Types/App/Interfaces/PricingCardInterface';
import PricingDetailCard from './PricingDetailCard.vue';

const { card }: { card: PricingCardInterface } = defineProps<{
    card: PricingCardInterface;
}>();

const hasBorder = (index: number): boolean => {
    return index < card.details.length - 1;
};
</script>
