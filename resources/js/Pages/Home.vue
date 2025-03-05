<template>
    <Layout>
        <HeroSection></HeroSection>
        <FeaturedProperties></FeaturedProperties>
        <ClientTestimonials></ClientTestimonials>
        <FaqSection></FaqSection>
    </Layout>
</template>

<script lang="ts" setup>
import ClientTestimonials from '@/Components/Home/ClientTestimonials.vue';
import FaqSection from '@/Components/Home/FaqSection.vue';
import FeaturedProperties from '@/Components/Home/FeaturedProperties.vue';
import HeroSection from '@/Components/Home/HeroSection.vue';
import Layout from '@/Layouts/Layout.vue';
</script>
