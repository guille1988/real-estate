<template>
    <Layout>
        <HeroSection />
        <FeaturedProperties :featured-properties="featuredProperties" />
        <ClientTestimonials :testimonials="testimonials" />
        <Faq :faq="faq" />
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
import { FaqInterface } from '@/Types/App/Interfaces/FaqInterface';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';
import { TestimonialInterface } from '@/Types/App/Interfaces/TestimonialInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    featuredProperties: IndexPropertyInterface[];
    testimonials: TestimonialInterface[];
    faq: FaqInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
