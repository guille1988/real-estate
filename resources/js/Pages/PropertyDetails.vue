<template>
    <Layout>
        <Gallery :property="property" />
        <Inquire :title="property.title" />
        <Pricing
            :price="property.price"
            :pricingDetails="property.pricingDetails"
        />
        <Faq :faq="faq" />
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';
import Gallery from '@/Components/PropertyDetails/Gallery/Gallery.vue';
import Inquire from '@/Components/PropertyDetails/Inquire/Inquire.vue';
import Pricing from '@/Components/PropertyDetails/Pricing/Pricing.vue';
import Faq from '@/Components/Shared/Faq/Faq.vue';
import { FaqInterface } from '@/Types/App/Interfaces/FaqInterface';
import { ShowPropertyInterface } from '@/Types/App/Interfaces/ShowPropertyInterface';

defineProps<{
    property: ShowPropertyInterface;
    faq: FaqInterface[];
}>();
</script>
