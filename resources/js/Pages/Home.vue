<template>
    <Layout>
        <HeroSection />
        <FeaturedProperties :featured-properties="featuredProperties" />
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
import { displayErrors } from '@/Composables/useErrorHandling';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    featuredProperties: IndexPropertyInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
