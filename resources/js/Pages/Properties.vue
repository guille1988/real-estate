<template>
    <Layout>
        <Search :properties="properties" :filters="filters" />
        <MakeItHappen />
    </Layout>
</template>

<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';
import MakeItHappen from '@/Components/Properties/MakeItHappen/MakeItHappen.vue';
import Search from '@/Components/Properties/Search/Search.vue';
import { FilterInterface } from '@/Types/App/Interfaces/FilterInterface';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';

defineProps<{
    properties: IndexPropertyInterface[];
    filters: FilterInterface;
}>();
</script>
