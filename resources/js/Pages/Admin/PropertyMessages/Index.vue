<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <Index
                :propertyMessages="propertyMessages"
                :propertyTypes="propertyTypes"
            />>
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import Index from '@/Components/Admin/PropertyMessages/Index.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { IndexPropertyMessagePaginatedInterface } from '@/Types/Admin/Interfaces/IndexPropertyMessagePaginatedInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    propertyMessages: IndexPropertyMessagePaginatedInterface;
    propertyTypes: PropertyTypeInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
