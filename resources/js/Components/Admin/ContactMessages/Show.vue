<template>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">
                    Contact Message
                </h1>
                <p class="mt-2 text-sm text-gray-300">Detailed information</p>
            </div>
            <BackToIndexButton :url="ContactMessageController.index().url" />
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
                            {{ contactMessage.uuid }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">First Name</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ contactMessage.firstName }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">E-mail</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ contactMessage.email }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">Last Name</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ contactMessage.lastName }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">Phone</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ contactMessage.phone }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">Read At</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ contactMessage.readAt }}
                        </div>
                    </div>

                    <div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="mb-2 block text-sm"
                                    >Property Type</label
                                >
                                <span :class="getInquiryTypeClass()">
                                    {{ contactMessage.inquiryType }}
                                </span>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm">Source</label>
                                <span :class="getSourceClass()">
                                    {{ contactMessage.source }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div
                        v-if="
                            contactMessage.createdAt && contactMessage.updatedAt
                        "
                    >
                        <div class="grid grid-cols-2 gap-6">
                            <div v-if="contactMessage.createdAt">
                                <label class="mb-2 block text-sm"
                                    >Created At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ contactMessage.createdAt }}
                                </div>
                            </div>
                            <div v-if="contactMessage.updatedAt">
                                <label class="mb-2 block text-sm"
                                    >Updated At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ contactMessage.updatedAt }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm">Message</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ contactMessage.message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import ContactMessageController from '@/Routes/actions/App/Http/Controllers/Admin/ContactMessageController';
import { ShowContactMessageInterface } from '@/Types/Admin/Interfaces/ShowContactMessageInterface';
import { ContactMessageInquiryTypeColors } from '@/Types/App/Enums/ContactMessageInquiryTypeEnum';
import { ContactMessageSourceColors } from '@/Types/App/Enums/ContactMessageSourceEnum';

const { contactMessage }: { contactMessage: ShowContactMessageInterface } =
    defineProps<{
        contactMessage: ShowContactMessageInterface;
    }>();

const getInquiryTypeClass = (): string => {
    const color: string =
        ContactMessageInquiryTypeColors[contactMessage.inquiryType];

    return `inline-flex items-center rounded-md bg-${color}-900/30 px-2 py-1 text-xs font-medium uppercase text-${color}-400 ring-1 ring-inset ring-${color}-500/50`;
};

const getSourceClass = (): string => {
    const color: string = ContactMessageSourceColors[contactMessage.source];

    return `inline-flex items-center rounded-md bg-${color}-900/30 px-2 py-1 text-xs font-medium uppercase text-${color}-400 ring-1 ring-inset ring-${color}-500/50`;
};
</script>
