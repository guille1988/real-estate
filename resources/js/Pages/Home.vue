<template>
    <Layout>
        <HeroSection :blue-building="assets.blueBuilding" />
        <FeaturedProperties :properties="properties" :filterPage="page" />
        <ClientTestimonials :testimonials="testimonials" />
        <Faq :faq="faq" />
    </Layout>
</template>

<script setup lang="ts">
import ClientTestimonials from '@/Components/Home/ClientTestimonials/ClientTestimonials.vue';
import FeaturedProperties from '@/Components/Home/FeaturedProperties/FeaturedProperties.vue';
import HeroSection from '@/Components/Home/HeroSection/HeroSection.vue';
import Layout from '@/Components/Layouts/Layout.vue';
import Faq from '@/Components/Shared/Faq/Faq.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { FaqInterface } from '@/Types/App/Interfaces/FaqInterface';
import { HomeAssetsInterface } from '@/Types/App/Interfaces/HomeAssetsInterface';
import { IndexPropertyPaginatedInterface } from '@/Types/App/Interfaces/IndexPropertyPaginatedInterface';
import { TestimonialInterface } from '@/Types/App/Interfaces/TestimonialInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    assets: HomeAssetsInterface;
    properties: IndexPropertyPaginatedInterface;
    page: number | null;
    testimonials: TestimonialInterface[];
    faq: FaqInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
