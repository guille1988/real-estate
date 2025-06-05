<template>
    <section class="w-full bg-black py-16 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-10 max-w-4xl">
                <ThreeStars />
                <h2 class="mb-4 text-3xl font-medium">
                    Comprehensive Pricing Details
                </h2>
                <p class="mb-6 text-gray-400">
                    A detailed breakdown of how the cost of home ownership is
                    calculated associated with your property investment. Below,
                    we break down the pricing for Seaside Serenity Villa so that
                    you make an informed decision.
                </p>

                <div
                    class="mb-10 border border-neutral-700 bg-neutral-900/50 p-4"
                >
                    <p class="text-sm text-gray-400">
                        <span class="font-semibold">Note —</span> The figures
                        provided above are estimates and may vary depending on
                        the property's location, and individual circumstances.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div>
                    <h3 class="mb-2 text-sm uppercase text-gray-400">
                        LISTING PRICE
                    </h3>
                    <p class="text-3xl font-medium">$1,250,000</p>
                </div>

                <div class="space-y-8 md:col-span-2">
                    <div class="border border-neutral-700 p-6">
                        <div class="mb-6 flex items-center justify-between">
                            <h4 class="text-lg font-medium">Additional Fees</h4>
                            <button
                                class="rounded-lg bg-neutral-800 px-8 py-3 text-sm text-gray-400 shadow-sm hover:bg-neutral-700"
                            >
                                Learn More
                            </button>
                        </div>

                        <div class="space-y-6">
                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Property Transfer Tax
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        Based on the sale price and local
                                        regulations
                                    </p>
                                </div>
                                <p class="font-medium">$25,000</p>
                            </div>

                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">Legal Fees</h5>
                                    <p class="text-sm text-gray-400">
                                        Approximate cost for legal services
                                        including title transfer
                                    </p>
                                </div>
                                <p class="font-medium">$3,000</p>
                            </div>

                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Home Inspection
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        Recommended for due diligence
                                    </p>
                                </div>
                                <p class="font-medium">$500</p>
                            </div>

                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Property Insurance
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        Annual cost for comprehensive property
                                        insurance
                                    </p>
                                </div>
                                <p class="font-medium">$1,200</p>
                            </div>

                            <div class="flex items-start justify-between">
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Brokerage Fees
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        If applicable, consult with your broker
                                        for specific details
                                    </p>
                                </div>
                                <p class="font-medium">Varies</p>
                            </div>
                        </div>
                    </div>

                    <div class="border border-neutral-700 p-6">
                        <div class="mb-6 flex items-center justify-between">
                            <h4 class="text-lg font-medium">Monthly Costs</h4>
                            <button
                                class="rounded-lg bg-neutral-800 px-8 py-3 text-sm text-gray-400 shadow-sm hover:bg-neutral-700"
                            >
                                Learn More
                            </button>
                        </div>

                        <div class="space-y-6">
                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Property Taxes
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        Approximate monthly property tax based
                                        on the sale price and local rates
                                    </p>
                                </div>
                                <p class="font-medium">$1,250</p>
                            </div>

                            <div class="flex items-start justify-between">
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        HOA Association Fee
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        Monthly fee for common area maintenance
                                        and security
                                    </p>
                                </div>
                                <p class="font-medium">$300</p>
                            </div>
                        </div>
                    </div>

                    <div class="border border-neutral-700 p-6">
                        <div class="mb-6 flex items-center justify-between">
                            <h4 class="text-lg font-medium">
                                Total Initial Costs
                            </h4>
                            <button
                                class="rounded-lg bg-neutral-800 px-8 py-3 text-sm text-gray-400 shadow-sm hover:bg-neutral-700"
                            >
                                Learn More
                            </button>
                        </div>

                        <div class="space-y-6">
                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Listing Price
                                    </h5>
                                </div>
                                <p class="font-medium">$1,250,000</p>
                            </div>

                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Additional Fees
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        Property transfer tax, legal fees,
                                        inspection, insurance
                                    </p>
                                </div>
                                <p class="font-medium">$29,700</p>
                            </div>

                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Down Payment
                                    </h5>
                                    <p class="text-sm text-gray-400">20%</p>
                                </div>
                                <p class="font-medium">$250,000</p>
                            </div>

                            <div class="flex items-start justify-between">
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Mortgage Amount
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        If applicable
                                    </p>
                                </div>
                                <p class="font-medium">$1,000,000</p>
                            </div>
                        </div>
                    </div>

                    <div class="border border-neutral-700 p-6">
                        <div class="mb-6 flex items-center justify-between">
                            <h4 class="text-lg font-medium">
                                Monthly Expenses
                            </h4>
                            <button
                                class="rounded-lg bg-neutral-800 px-8 py-3 text-sm text-gray-400 shadow-sm hover:bg-neutral-700"
                            >
                                Learn More
                            </button>
                        </div>

                        <div class="space-y-6">
                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Property Taxes
                                    </h5>
                                </div>
                                <p class="font-medium">$1,250</p>
                            </div>

                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        HOA Association Fee
                                    </h5>
                                </div>
                                <p class="font-medium">$300</p>
                            </div>

                            <div
                                class="flex items-start justify-between border-b border-neutral-700 pb-4"
                            >
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Mortgage Payment
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        Varies based on terms and interest rate
                                    </p>
                                </div>
                                <p class="font-medium text-gray-400">
                                    If applicable
                                </p>
                            </div>

                            <div class="flex items-start justify-between">
                                <div>
                                    <h5 class="mb-1 font-medium">
                                        Property Insurance
                                    </h5>
                                    <p class="text-sm text-gray-400">
                                        Approximate monthly cost
                                    </p>
                                </div>
                                <p class="font-medium">$100</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
</script>
