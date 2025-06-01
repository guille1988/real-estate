<template>
    <Layout>
        <Search></Search>
        <List></List>
        <ContactForm></ContactForm>
    </Layout>
</template>

<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';
import ContactForm from '@/Components/Properties/ContactForm.vue';
import List from '@/Components/Properties/List.vue';
import Search from '@/Components/Properties/Search/Search.vue';
</script>
