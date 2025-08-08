<template>
    <Layout>
        <Search
            :properties="properties"
            :locations="locations"
            :types="types"
            :filters="filters"
        />
        <MakeItHappen />
    </Layout>
</template>

<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';
import MakeItHappen from '@/Components/Properties/MakeItHappen/MakeItHappen.vue';
import Search from '@/Components/Properties/Search/Search.vue';
import { FilterInterface } from '@/Types/App/Interfaces/FilterInterface';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';

defineProps<{
    properties: IndexPropertyInterface[];
    locations: PropertyLocationInterface[];
    types: PropertyTypeInterface[];
    filters: FilterInterface;
}>();
</script>
