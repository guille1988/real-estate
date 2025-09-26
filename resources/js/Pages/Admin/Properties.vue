<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <Index :properties="properties" />
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import Index from '@/Components/Admin/Properties/Index.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { IndexPropertyPaginatedInterface } from '@/Types/Admin/Interfaces/IndexPropertyPaginatedInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    properties: IndexPropertyPaginatedInterface;
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
