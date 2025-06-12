<template>
    <section class="w-full bg-black py-8 text-white" id="smart-investments">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-3">
                <div class="lg:col-span-1">
                    <div class="mb-8">
                        <ThreeStars />
                        <h2 class="mb-4 text-3xl font-medium">
                            Smart Investments,<br />
                            Informed Decisions
                        </h2>
                        <p class="mb-8 text-gray-400">
                            Building a real estate portfolio requires a
                            strategic approach. Real estate's Investment
                            Advisory Service empowers you to make smart
                            investments and informed decisions.
                        </p>
                    </div>

                    <div
                        class="mb-8 border border-neutral-800 bg-gray-800/50 p-6 lg:mb-0"
                    >
                        <h3 class="mb-8 text-center text-xl font-medium">
                            Unlock Your Investment Potential
                        </h3>
                        <p class="mx-4 mb-10 text-gray-400">
                            Explore our Property Management Service categories
                            and let us handle the complexities while you enjoy
                            the benefits of property ownership.
                        </p>
                        <div class="text-center">
                            <button
                                class="rounded-md bg-black px-6 py-3 text-white transition-colors duration-300 hover:bg-neutral-800"
                            >
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid gap-8 lg:col-span-2 lg:grid-cols-2">
                    <SmartInvestmentsCard
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
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import SmartInvestmentsCard from '@/Components/Services/SmartInvestments/SmartInvestmentsCard.vue';
import { SmartInvestmentsCardInterface } from '@/Types/App/Interfaces';

const cards: SmartInvestmentsCardInterface[] = [
    {
        id: 1,
        icon: 'ChartIcon',
        title: 'Market Insight',
        description:
            'Stay ahead of market trends with our expert Market Analysis. We provide in-depth insights into real estate market conditions.',
    },
    {
        id: 2,
        icon: 'FlameIcon',
        title: 'ROI Assessment',
        description:
            'Make investment decisions with confidence. Our ROI Assessment services evaluate the potential returns on your investments.',
    },
    {
        id: 3,
        icon: 'LampIcon',
        title: 'Customized Strategies',
        description:
            'Every investor is unique and so are their goals. We develop Customized Investment Strategies tailored to your specific needs.',
    },
    {
        id: 4,
        icon: 'SunIcon',
        title: 'Diversification Mastery',
        description:
            'Diversify your real estate portfolio effectively. Our experts guide you in spreading your investments across various property types and locations.',
    },
];
</script>
