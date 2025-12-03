<template>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">
                    Property Message
                </h1>
                <p class="mt-2 text-sm text-gray-300">Detailed information</p>
            </div>
            <BackToIndexButton :url="PropertyMessageController.index().url" />
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
                            {{ propertyMessage.uuid }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">First Name</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ propertyMessage.firstName }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">E-mail</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ propertyMessage.email }}
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
                                    {{ propertyMessage.bathrooms }}
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm"
                                    >Bedrooms</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ propertyMessage.bedrooms }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">Property Type</label>
                        <span :class="getPropertyTypeClass()">
                            {{ propertyMessage.propertyType }}
                        </span>
                    </div>

                    <div v-if="propertyMessage.readAt">
                        <label class="mb-2 block text-sm">Read At</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ propertyMessage.readAt }}
                        </div>
                    </div>

                    <div
                        v-if="
                            propertyMessage.createdAt &&
                            propertyMessage.updatedAt
                        "
                        class="md:col-start-2"
                    >
                        <div class="grid grid-cols-2 gap-6">
                            <div v-if="propertyMessage.createdAt">
                                <label class="mb-2 block text-sm"
                                    >Created At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ propertyMessage.createdAt }}
                                </div>
                            </div>
                            <div v-if="propertyMessage.updatedAt">
                                <label class="mb-2 block text-sm"
                                    >Updated At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ propertyMessage.updatedAt }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm">Last Name</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ propertyMessage.lastName }}
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm">Message</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ propertyMessage.message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import PropertyMessageController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyMessageController';
import { ShowPropertyMessageInterface } from '@/Types/Admin/Interfaces/ShowPropertyMessageInterface';
import { PropertyTypeColors } from '@/Types/App/Enums/PropertyTypeEnum';

const { propertyMessage }: { propertyMessage: ShowPropertyMessageInterface } =
    defineProps<{
        propertyMessage: ShowPropertyMessageInterface;
    }>();

const getPropertyTypeClass = (): string => {
    const color: string = PropertyTypeColors[propertyMessage.propertyType];

    return `inline-flex items-center rounded-md bg-${color}-900/30 px-2 py-1 text-xs font-medium uppercase text-${color}-400 ring-1 ring-inset ring-${color}-500/50`;
};
</script>
