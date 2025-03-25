<template>
    <Layout>
        <HeroSection></HeroSection>
        <FeaturedProperties></FeaturedProperties>
        <ClientTestimonials></ClientTestimonials>
        <Faq></Faq>
    </Layout>
</template>

<script setup lang="ts">
import ClientTestimonials from '@/Components/Home/ClientTestimonials.vue';
import Faq from '@/Components/Home/Faq.vue';
import FeaturedProperties from '@/Components/Home/FeaturedProperties.vue';
import HeroSection from '@/Components/Home/HeroSection.vue';
import Layout from '@/Components/Layout/Layout.vue';
</script>
