<template>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">Amenity</h1>
                <p class="mt-2 text-sm text-gray-300">Detailed information</p>
            </div>
            <BackToIndexButton :url="AmenityController.index().url" />
        </div>

        <div class="mt-8 flex min-h-0 flex-1 flex-col">
            <div
                class="min-h-0 flex-1 space-y-8 overflow-auto pb-8 pr-3 md:pr-4"
            >
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm">UUID</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ amenity.uuid }}
                        </div>
                    </div>
                    <div
                        v-if="amenity.createdAt && amenity.updatedAt"
                        class="md:col-start-2"
                    >
                        <div class="grid grid-cols-2 gap-6">
                            <div v-if="amenity.createdAt">
                                <label class="mb-2 block text-sm"
                                    >Created At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ amenity.createdAt }}
                                </div>
                            </div>
                            <div v-if="amenity.updatedAt">
                                <label class="mb-2 block text-sm"
                                    >Updated At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ amenity.updatedAt }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm">Description</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ amenity.description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import AmenityController from '@/Routes/actions/App/Http/Controllers/Admin/AmenityController';
import { ShowAmenityInterface } from '@/Types/Admin/Interfaces/ShowAmenityInterface';

const { amenity }: { amenity: ShowAmenityInterface } = defineProps<{
    amenity: ShowAmenityInterface;
}>();
</script>
