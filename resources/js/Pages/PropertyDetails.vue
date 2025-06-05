<template>
    <Layout>
        <Gallery />
        <Inquire />
        <Pricing />
        <Faq />
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';
import Gallery from '@/Components/PropertyDetails/Gallery.vue';
import Inquire from '@/Components/PropertyDetails/Inquire.vue';
import Pricing from '@/Components/PropertyDetails/Pricing.vue';
import Faq from '@/Components/Shared/Faq/Faq.vue';
</script>
