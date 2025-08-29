<template>
    <section class="w-full bg-black py-8 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <WhenVisible :data="['price', 'pricingDetails']">
                <template #fallback>
                    <div class="animate-pulse">
                        <div class="mb-10 max-w-4xl">
                            <div
                                class="mb-4 h-6 w-24 rounded bg-gray-700/50"
                            ></div>
                            <div
                                class="mb-4 h-8 w-80 rounded bg-gray-700/50"
                            ></div>
                            <div
                                class="mb-6 h-5 w-2/3 rounded bg-gray-700/40"
                            ></div>
                            <div
                                class="mb-10 border border-neutral-700 bg-neutral-900/50 p-4"
                            >
                                <div
                                    class="h-4 w-full rounded bg-gray-700/30"
                                ></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                            <div>
                                <div
                                    class="mb-2 h-4 w-32 rounded bg-gray-700/40"
                                ></div>
                                <div
                                    class="h-8 w-40 rounded bg-gray-700/50"
                                ></div>
                            </div>
                            <div class="space-y-8 md:col-span-2">
                                <div
                                    v-for="n in 3"
                                    :key="n"
                                    class="border border-neutral-700 p-6"
                                >
                                    <div
                                        class="mb-6 h-5 w-40 rounded bg-gray-700/50"
                                    ></div>
                                    <div class="space-y-6">
                                        <div
                                            v-for="i in 3"
                                            :key="i"
                                            class="flex items-start justify-between border-b border-neutral-700 pb-4"
                                        >
                                            <div>
                                                <div
                                                    class="mb-2 h-4 w-48 rounded bg-gray-700/50"
                                                ></div>
                                                <div
                                                    class="h-3 w-64 rounded bg-gray-700/40"
                                                ></div>
                                            </div>
                                            <div
                                                class="h-4 w-24 rounded bg-gray-700/50"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="mb-10 max-w-4xl">
                    <ThreeStars />
                    <h2 class="mb-4 text-3xl font-medium">
                        Comprehensive Pricing Details
                    </h2>
                    <p class="mb-6 text-gray-400">
                        A detailed breakdown of how the cost of home ownership
                        is calculated associated with your property investment.
                        Below, we break down the pricing for Seaside Serenity
                        Villa so that you make an informed decision.
                    </p>

                    <div
                        class="mb-10 border border-neutral-700 bg-neutral-900/50 p-4"
                    >
                        <p class="text-sm text-gray-400">
                            <span class="font-semibold">Note —</span> The
                            figures provided above are estimates and may vary
                            depending on the property's location, and individual
                            circumstances.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div>
                        <h3 class="mb-2 text-sm uppercase text-gray-400">
                            LISTING PRICE
                        </h3>
                        <p class="text-3xl font-medium">
                            {{ price }}
                        </p>
                    </div>

                    <div class="space-y-8 md:col-span-2">
                        <PricingCard
                            v-for="(card, cardIndex) in pricingDetails"
                            :key="cardIndex"
                            :card="card"
                        />
                    </div>
                </div>
            </WhenVisible>
        </div>
    </section>
</template>
<script setup lang="ts">
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { PricingCardInterface } from '@/Types/App/Interfaces/PricingCardInterface';
import { WhenVisible } from '@inertiajs/vue3';
import PricingCard from './PricingCard.vue';

defineProps<{
    price: string;
    pricingDetails: PricingCardInterface[];
}>();
</script>
