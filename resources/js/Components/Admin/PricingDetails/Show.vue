<template>
    <h1>Show view.</h1>
</template>

<script setup lang="ts">
import { ShowPricingDetailInterface } from '@/Types/Admin/Interfaces/ShowPricingDetailInterface';

defineProps<{
    pricingDetail: ShowPricingDetailInterface;
}>();
</script>
