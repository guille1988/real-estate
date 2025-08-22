<template>
    <Layout>
        <Search
            :properties="properties"
            :areas="areas"
            :locations="locations"
            :prices="prices"
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
import { displayErrors } from '@/Composables/useErrorHandling';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { FilterInterface } from '@/Types/App/Interfaces/FilterInterface';
import { IndexPropertyPaginatedInterface } from '@/Types/App/Interfaces/IndexPropertyPaginatedInterface';
import { PropertyAreaRangeInterface } from '@/Types/App/Interfaces/PropertyAreaRangeInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyPriceRangeInterface } from '@/Types/App/Interfaces/PropertyPriceRangeInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    properties: IndexPropertyPaginatedInterface;
    areas: PropertyAreaRangeInterface[];
    locations: PropertyLocationInterface[];
    prices: PropertyPriceRangeInterface[];
    types: PropertyTypeInterface[];
    filters: FilterInterface;
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
