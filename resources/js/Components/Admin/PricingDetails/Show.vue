<template>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">
                    Pricing Detail
                </h1>
                <p class="mt-2 text-sm text-gray-300">Detailed information</p>
            </div>
            <BackToIndexButton :url="PricingDetailController.index().url" />
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
                            {{ pricingDetail.uuid }}
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm">Name</label>
                        <div
                            class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ pricingDetail.name }}
                        </div>
                    </div>

                    <div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="mb-2 block text-sm"
                                    >Category</label
                                >
                                <span :class="getCategoryClass()">{{
                                    pricingDetail.category
                                }}</span>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm">Price</label>
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ pricingDetail.price }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        v-if="
                            pricingDetail.createdAt && pricingDetail.updatedAt
                        "
                        class="md:col-start-2"
                    >
                        <div class="grid grid-cols-2 gap-6">
                            <div v-if="pricingDetail.createdAt">
                                <label class="mb-2 block text-sm"
                                    >Created At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ pricingDetail.createdAt }}
                                </div>
                            </div>
                            <div v-if="pricingDetail.updatedAt">
                                <label class="mb-2 block text-sm"
                                    >Updated At</label
                                >
                                <div
                                    class="rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                                >
                                    {{ pricingDetail.updatedAt }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm">Description</label>
                        <div
                            class="whitespace-pre-line rounded border border-gray-700 bg-black/70 p-3 text-sm text-gray-300"
                        >
                            {{ pricingDetail.description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import PricingDetailController from '@/Routes/actions/App/Http/Controllers/Admin/PricingDetailController';
import { PricingDetailCategoryColors } from '@/Types/Admin/Enums/PricingDetailCategoryEnum';
import { ShowPricingDetailInterface } from '@/Types/Admin/Interfaces/ShowPricingDetailInterface';

const { pricingDetail }: { pricingDetail: ShowPricingDetailInterface } =
    defineProps<{
        pricingDetail: ShowPricingDetailInterface;
    }>();

const getCategoryClass = (): string => {
    const color: string = PricingDetailCategoryColors[pricingDetail.category];

    return `inline-flex items-center rounded-md bg-${color}-900/30 px-2 py-1 text-xs font-medium uppercase text-${color}-400 ring-1 ring-inset ring-${color}-500/50`;
};
</script>
