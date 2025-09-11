<template>
    <Layout>
        <GetInTouch />
        <LetsConnect :inquiry-types="inquiryTypes" :sources="sources" />
        <OfficeLocations :office-locations="officeLocations" />
        <Explore :assets="assets" />
    </Layout>
</template>

<script setup lang="ts">
import Explore from '@/Components/Contact/Explore/Explore.vue';
import GetInTouch from '@/Components/Contact/GetInTouch/GetInTouch.vue';
import LetsConnect from '@/Components/Contact/LetsConnect/LetsConnect.vue';
import OfficeLocations from '@/Components/Contact/OfficeLocations/OfficeLocations.vue';
import Layout from '@/Components/Layouts/Layout.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { ContactAssetsInterface } from '@/Types/App/Interfaces/ContactAssetsInterface';
import { ContactInquiryTypeInterface } from '@/Types/App/Interfaces/ContactInquiryTypeInterface';
import { ContactSourceInterface } from '@/Types/App/Interfaces/ContactSourceInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { OfficeLocationInterface } from '@/Types/App/Interfaces/OfficeLocationInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    assets: ContactAssetsInterface;
    officeLocations: OfficeLocationInterface[];
    inquiryTypes: ContactInquiryTypeInterface[];
    sources: ContactSourceInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
