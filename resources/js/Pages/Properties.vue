<template>
    <Layout>
        <HeroSection></HeroSection>
        <List></List>
        <ContactForm></ContactForm>
    </Layout>
</template>

<script lang="ts" setup>
import ContactForm from '@/Components/Properties/ContactForm.vue';
import HeroSection from '@/Components/Properties/HeroSection.vue';
import List from '@/Components/Properties/List.vue';
import Layout from '@/Layouts/Layout.vue';
</script>
