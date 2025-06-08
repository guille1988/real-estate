<template>
    <section class="w-full bg-black py-8 text-white" id="unlock-property-value">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-16 max-w-3xl">
                <ThreeStars />
                <h2 class="mb-4 text-3xl font-medium">Unlock Property Value</h2>
                <p class="leading-relaxed text-gray-400">
                    Selling your property should be a rewarding experience, and
                    at Real estate, we make sure it is. Our Property Selling
                    Service is designed to maximize the value of your property,
                    ensuring you get the best deal possible. Explore the
                    categories below to see how we can help you at every step of
                    your selling journey.
                </p>
            </div>

            <div
                class="mb-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3"
            >
                <UnlockPropertyCard
                    v-for="card in getFirstThreeCards()"
                    :key="card.id"
                    :card="card"
                />
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <UnlockPropertyCard :card="getLastCard()" />

                <div
                    class="border border-neutral-800 bg-neutral-900 p-6 md:col-span-2"
                >
                    <div
                        class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between"
                    >
                        <h2
                            class="mb-4 text-2xl font-medium sm:mb-0 lg:text-3xl"
                        >
                            Unlock the Value of Your Property Today
                        </h2>
                        <button
                            class="self-start bg-black px-6 py-3 text-white transition-colors duration-300 sm:self-center"
                        >
                            Learn More
                        </button>
                    </div>

                    <p class="text-gray-400">
                        Ready to unlock the true value of your property? Explore
                        our Property Selling Service categories and let us help
                        you achieve the best deal possible for your valuable
                        asset.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import UnlockPropertyCard from '@/Components/Services/UnlockPropertyValue/UnlockPropertyCard/UnlockPropertyCard.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { UnlockPropertyCardInterface } from '@/Types/App/Interfaces';

const cards: UnlockPropertyCardInterface[] = [
    {
        id: 1,
        icon: 'ChartIcon',
        title: 'Valuation Mastery',
        description:
            'Discover the true worth of your property with our expert valuation services.',
    },
    {
        id: 2,
        icon: 'PieChartIcon',
        title: 'Strategic Marketing',
        description:
            'Selling a property requires more than just a listing, it demands a strategic marketing approach.',
    },
    {
        id: 3,
        icon: 'DotsIcon',
        title: 'Negotiation Wizardry',
        description:
            'Negotiating the best deal is an art, and our negotiation experts are masters of it.',
    },
    {
        id: 4,
        icon: 'BookIcon',
        title: 'Closing Success',
        description:
            'A successful sale is not complete until the closing. We guide you through the intricate closing process.',
    },
];

const getFirstThreeCards = (): UnlockPropertyCardInterface[] =>
    cards.slice(0, 3);
const getLastCard = (): UnlockPropertyCardInterface => cards[cards.length - 1];
</script>
