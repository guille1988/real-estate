<template>
    <Layout>
        <PropertyHeroSection></PropertyHeroSection>
        <PropertyList></PropertyList>
        <PropertyContactForm></PropertyContactForm>
    </Layout>
</template>

<script lang="ts" setup>
import PropertyContactForm from '@/Components/Home/PropertyContactForm.vue';
import PropertyHeroSection from '@/Components/Home/PropertyHeroSection.vue';
import PropertyList from '@/Components/Home/PropertyList.vue';
import Layout from '@/Layouts/Layout.vue';
</script>
