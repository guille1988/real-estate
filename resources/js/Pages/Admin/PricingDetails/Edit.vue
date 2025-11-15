<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <Edit :pricingDetail="pricingDetail" />
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import Edit from '@/Components/Admin/PricingDetails/Edit.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { EditPricingDetailInterface } from '@/Types/Admin/Interfaces/EditPricingDetailInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    pricingDetail: EditPricingDetailInterface;
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
