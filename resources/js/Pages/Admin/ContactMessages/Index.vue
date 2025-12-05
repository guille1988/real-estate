<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <Index :contactMessages="contactMessages" />
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Index from '@/Components/Admin/ContactMessages/Index.vue';
import Layout from '@/Components/Admin/Layout/Layout.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { IndexContactMessagePaginatedInterface } from '@/Types/Admin/Interfaces/IndexContactMessagePaginatedInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    contactMessages: IndexContactMessagePaginatedInterface;
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
