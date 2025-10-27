<template>
    <Layout>
        <Show :property="property" />
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import Show from '@/Components/Admin/Properties/Show.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { ShowPropertyInterface } from '@/Types/Admin/Interfaces/ShowPropertyInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    property: ShowPropertyInterface;
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
