<template>
    <Layout>
        <Create :types="types" :locations="locations" />
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import Create from '@/Components/Admin/Properties/Create.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    locations: PropertyLocationInterface[];
    types: PropertyTypeInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
