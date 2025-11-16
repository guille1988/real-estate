<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <Edit :amenity="amenity" :properties="properties" />
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Edit from '@/Components/Admin/Amenities/Edit.vue';
import Layout from '@/Components/Admin/Layout/Layout.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { EditAmenityInterface } from '@/Types/Admin/Interfaces/EditAmenityInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    amenity: EditAmenityInterface;
    properties: SelectFilterOptionType[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
