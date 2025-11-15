<template>
    <h1>
        Here goes the development of pricing detail: {{ pricingDetail.name }}
    </h1>
</template>

<script setup lang="ts">
import { EditPricingDetailInterface } from '@/Types/Admin/Interfaces/EditPricingDetailInterface';

const { pricingDetail }: { pricingDetail: EditPricingDetailInterface } =
    defineProps<{
        pricingDetail: EditPricingDetailInterface;
    }>();
</script>
