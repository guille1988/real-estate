<template>
    <Layout>
        <Gallery></Gallery>
        <Inquire></Inquire>
        <Pricing></Pricing>
        <Faq></Faq>
    </Layout>
</template>
<script setup lang="ts">
import Faq from '@/Components/Home/Faq.vue';
import Gallery from '@/Components/PropertyDetails/Gallery.vue';
import Inquire from '@/Components/PropertyDetails/Inquire.vue';
import Pricing from '@/Components/PropertyDetails/Pricing.vue';
import Layout from '@/Layouts/Layout.vue';
</script>
