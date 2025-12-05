<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <Index
                :contactMessages="contactMessages"
                :inquiry-types="inquiryTypes"
                :sources="sources"
            />
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Index from '@/Components/Admin/ContactMessages/Index.vue';
import Layout from '@/Components/Admin/Layout/Layout.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { IndexContactMessagePaginatedInterface } from '@/Types/Admin/Interfaces/IndexContactMessagePaginatedInterface';
import { ContactInquiryTypeInterface } from '@/Types/App/Interfaces/ContactInquiryTypeInterface';
import { ContactSourceInterface } from '@/Types/App/Interfaces/ContactSourceInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    contactMessages: IndexContactMessagePaginatedInterface;
    inquiryTypes: ContactInquiryTypeInterface[];
    sources: ContactSourceInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
