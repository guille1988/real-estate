<template>
    <div
        class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col overflow-hidden rounded-xl bg-black p-4 text-white md:p-6"
    >
        <div class="flex min-h-0 flex-1 flex-col">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-white">
                        Property Details
                    </h1>
                    <p class="mt-2 text-sm text-gray-300">
                        Detailed information
                    </p>
                </div>
                <BackToIndexButton :url="PropertyController.index().url" />
            </div>

            <div class="mt-8 flex min-h-0 flex-1 flex-col">
                <div
                    class="min-h-0 flex-1 space-y-8 overflow-auto pb-8 pr-3 md:pr-4"
                >
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm">Title</label>
                            <div
                                class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                            >
                                {{ property.title }}
                            </div>
                        </div>

                        <div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="mb-2 block text-sm"
                                        >Location</label
                                    >
                                    <div
                                        class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                    >
                                        {{ property.location }}
                                    </div>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm"
                                        >Type</label
                                    >
                                    <span :class="getTypeClass()">{{
                                        property.type
                                    }}</span>
                                </div>
                            </div>
                        </div>

                        <div v-if="property.caption">
                            <label class="mb-2 block text-sm">Caption</label>
                            <div
                                class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                            >
                                {{ property.caption }}
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm">Address</label>
                            <div
                                class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                            >
                                {{ property.address }}
                            </div>
                        </div>

                        <div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="mb-2 block text-sm"
                                        >Bathrooms</label
                                    >
                                    <div
                                        class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                    >
                                        {{ property.bathrooms }}
                                    </div>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm"
                                        >Bedrooms</label
                                    >
                                    <div
                                        class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                    >
                                        {{ property.bedrooms }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="mb-2 block text-sm"
                                        >Area</label
                                    >
                                    <div
                                        class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                    >
                                        {{ property.area }}
                                    </div>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm"
                                        >Price</label
                                    >
                                    <div
                                        class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                    >
                                        {{ property.price }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm">UUID</label>
                            <div
                                class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                            >
                                {{ property.uuid }}
                            </div>
                        </div>

                        <div v-if="property.isFeatured">
                            <label class="mb-2 block text-sm"
                                >Is Featured?</label
                            >
                            <div
                                class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                            >
                                {{ property.isFeatured }}
                            </div>
                        </div>

                        <div v-if="property.createdAt">
                            <label class="mb-2 block text-sm">Created At</label>
                            <div
                                class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                            >
                                {{ property.createdAt }}
                            </div>
                        </div>

                        <div v-if="property.updatedAt">
                            <label class="mb-2 block text-sm">Updated At</label>
                            <div
                                class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                            >
                                {{ property.updatedAt }}
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm"
                                >Description</label
                            >
                            <div
                                class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                            >
                                {{ property.description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import PropertyController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyController';
import { ShowPropertyInterface } from '@/Types/Admin/Interfaces/ShowPropertyInterface';
import { PropertyTypeColors } from '@/Types/App/Enums/PropertyTypeEnum';

const { property }: { property: ShowPropertyInterface } = defineProps<{
    property: ShowPropertyInterface;
}>();

const getTypeClass = (): string => {
    const color: string = PropertyTypeColors[property.type];

    return `inline-flex items-center rounded-md bg-${color}-900/30 px-2 py-1 text-xs font-medium uppercase text-${color}-400 ring-1 ring-inset ring-${color}-500/50`;
};
</script>
