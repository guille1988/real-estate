<template>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">Inquiry</h1>
                <p class="mt-2 text-sm text-gray-300">Detailed information</p>
            </div>
            <BackToIndexButton :url="InquiryController.index().url" />
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
                            {{ inquiry.uuid }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">First Name</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ inquiry.firstName }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">E-mail</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ inquiry.email }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">Last Name</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ inquiry.lastName }}
                        </div>
                    </div>

                    <div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="mb-2 block text-sm">Phone</label>
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ inquiry.phone }}
                                </div>
                            </div>
                            <div v-if="inquiry.readAt">
                                <label class="mb-2 block text-sm"
                                    >Read At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ inquiry.readAt }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="inquiry.createdAt && inquiry.updatedAt">
                        <div class="grid grid-cols-2 gap-6">
                            <div v-if="inquiry.createdAt">
                                <label class="mb-2 block text-sm"
                                    >Created At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ inquiry.createdAt }}
                                </div>
                            </div>
                            <div v-if="inquiry.updatedAt">
                                <label class="mb-2 block text-sm"
                                    >Updated At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ inquiry.updatedAt }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm">Message</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ inquiry.message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import InquiryController from '@/Routes/actions/App/Http/Controllers/Admin/InquiryController';
import { ShowInquiryInterface } from '@/Types/Admin/Interfaces/ShowInquiryInterface';

const { inquiry }: { inquiry: ShowInquiryInterface } = defineProps<{
    inquiry: ShowInquiryInterface;
}>();
</script>
