<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <Index :images="images" />
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Index from '@/Components/Admin/Images/Index.vue';
import Layout from '@/Components/Admin/Layout/Layout.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { IndexImagePaginatedInterface } from '@/Types/Admin/Interfaces/IndexImagePaginatedInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    images: IndexImagePaginatedInterface;
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
