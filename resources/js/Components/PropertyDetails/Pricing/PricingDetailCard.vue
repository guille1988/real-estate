<template>
    <div
        class="flex items-start justify-between"
        :class="{ 'border-b border-neutral-700 pb-4': hasBorder }"
    >
        <div>
            <h5 class="mb-1 font-medium">
                {{ detail.name }}
            </h5>
            <p v-if="detail.description" class="text-sm text-gray-400">
                {{ detail.description }}
            </p>
        </div>
        <p
            class="font-medium"
            :class="{ 'text-gray-400': detail.price === 'If applicable' }"
        >
            {{ detail.price }}
        </p>
    </div>
</template>

<script setup lang="ts">
import { PricingDetailInterface } from '@/Types/App/Interfaces/PricingDetailInterface';

defineProps<{
    detail: PricingDetailInterface;
    hasBorder: boolean;
}>();
</script>
