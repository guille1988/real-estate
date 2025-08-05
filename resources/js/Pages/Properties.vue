<template>
    <Layout>
        <Search :properties="properties" />
        <MakeItHappen />
    </Layout>
</template>

<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';
import MakeItHappen from '@/Components/Properties/MakeItHappen/MakeItHappen.vue';
import Search from '@/Components/Properties/Search/Search.vue';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';

defineProps<{
    properties: IndexPropertyInterface[];
}>();
</script>
