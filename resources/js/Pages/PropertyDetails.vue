<template>
    <Layout>
        <Gallery :property="property" />
        <Inquire :title="property.title" />
        <Pricing />
        <Faq />
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';
import Gallery from '@/Components/PropertyDetails/Gallery/Gallery.vue';
import Inquire from '@/Components/PropertyDetails/Inquire/Inquire.vue';
import Pricing from '@/Components/PropertyDetails/Pricing/Pricing.vue';
import Faq from '@/Components/Shared/Faq/Faq.vue';
import { PropertyInterface } from '@/Types/App/Interfaces/PropertyInterface';

defineProps<{
    property: PropertyInterface;
}>();
</script>
