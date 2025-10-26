<template>
    <Layout>
        <Edit :types="types" :locations="locations" :property="property" />
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import Edit from '@/Components/Admin/Properties/Edit.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { UpdatePropertyInterface } from '@/Types/Admin/Interfaces/UpdatePropertyInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    property: UpdatePropertyInterface;
    locations: PropertyLocationInterface[];
    types: PropertyTypeInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
