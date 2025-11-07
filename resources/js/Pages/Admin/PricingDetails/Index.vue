<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <Index :pricingDetails="pricingDetails" :categories="categories" />
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import Index from '@/Components/Admin/PricingDetails/Index.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { IndexPricingDetailsPaginatedInterface } from '@/Types/Admin/Interfaces/IndexPricingDetailsPaginatedInterface';
import { PricingDetailCategoryInterface } from '@/Types/Admin/Interfaces/PricingDetailCategoryInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    pricingDetails: IndexPricingDetailsPaginatedInterface;
    categories: PricingDetailCategoryInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
