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
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import PropertyMessageController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyMessageController';
import { ShowPropertyMessageInterface } from '@/Types/Admin/Interfaces/ShowPropertyMessageInterface';

const { propertyMessage }: { propertyMessage: ShowPropertyMessageInterface } =
    defineProps<{
        propertyMessage: ShowPropertyMessageInterface;
    }>();
</script>
