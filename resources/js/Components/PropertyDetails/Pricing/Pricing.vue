<template>
    <section class="w-full bg-black py-8 text-white">
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
                    <p class="text-3xl font-medium">
                        {{ listingPrice }}
                    </p>
                </div>

                <div class="space-y-8 md:col-span-2">
                    <PricingCard
                        v-for="card in cards"
                        :key="card.id"
                        :card="card"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { PricingCardInterface } from '@/Types/App/Interfaces';
import PricingCard from './PricingCard.vue';

const listingPrice = '$1,250,000';

const cards: PricingCardInterface[] = [
    {
        id: 1,
        subject: 'Additional Fees',
        link: '#',
        details: [
            {
                id: 1,
                name: 'Property Transfer Tax',
                description: 'Based on the sale price and local regulations',
                price: '$25,000',
            },
            {
                id: 2,
                name: 'Legal Fees',
                description:
                    'Approximate cost for legal services including title transfer',
                price: '$3,000',
            },
            {
                id: 3,
                name: 'Home Inspection',
                description: 'Recommended for due diligence',
                price: '$500',
            },
            {
                id: 4,
                name: 'Property Insurance',
                description: 'Annual cost for comprehensive property insurance',
                price: '$1,200',
            },
            {
                id: 5,
                name: 'Brokerage Fees',
                description:
                    'If applicable, consult with your broker for specific details',
                price: 'Varies',
            },
        ],
    },
    {
        id: 2,
        subject: 'Monthly Costs',
        link: '#',
        details: [
            {
                id: 1,
                name: 'Property Taxes',
                description:
                    'Approximate monthly property tax based on the sale price and local rates',
                price: '$1,250',
            },
            {
                id: 2,
                name: 'HOA Association Fee',
                description:
                    'Monthly fee for common area maintenance and security',
                price: '$300',
            },
        ],
    },
    {
        id: 3,
        subject: 'Total Initial Costs',
        link: '#',
        details: [
            {
                id: 1,
                name: 'Listing Price',
                description: '',
                price: '$1,250,000',
            },
            {
                id: 2,
                name: 'Additional Fees',
                description:
                    'Property transfer tax, legal fees, inspection, insurance',
                price: '$29,700',
            },
            {
                id: 3,
                name: 'Down Payment',
                description: '20%',
                price: '$250,000',
            },
            {
                id: 4,
                name: 'Mortgage Amount',
                description: 'If applicable',
                price: '$1,000,000',
            },
        ],
    },
    {
        id: 4,
        subject: 'Monthly Expenses',
        link: '#',
        details: [
            {
                id: 1,
                name: 'Property Taxes',
                description: '',
                price: '$1,250',
            },
            {
                id: 2,
                name: 'HOA Association Fee',
                description: '',
                price: '$300',
            },
            {
                id: 3,
                name: 'Mortgage Payment',
                description: 'Varies based on terms and interest rate',
                price: 'If applicable',
            },
            {
                id: 4,
                name: 'Property Insurance',
                description: 'Approximate monthly cost',
                price: '$100',
            },
        ],
    },
];
</script>
