<template>
    <Layout>
        <HeroSection />
        <FeaturedProperties :featured_properties="featured_properties" />
        <ClientTestimonials />
        <Faq />
    </Layout>
</template>

<script setup lang="ts">
import ClientTestimonials from '@/Components/Home/ClientTestimonials/ClientTestimonials.vue';
import FeaturedProperties from '@/Components/Home/FeaturedProperties/FeaturedProperties.vue';
import HeroSection from '@/Components/Home/HeroSection/HeroSection.vue';
import Layout from '@/Components/Layout/Layout.vue';
import Faq from '@/Components/Shared/Faq/Faq.vue';
import { FeaturedPropertyCardInterface } from '@/Types/App/Interfaces/FeaturedPropertyCardInterface';

defineProps<{
    featured_properties: FeaturedPropertyCardInterface[];
}>();
</script>
