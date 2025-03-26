<template>
    <section
        class="w-full max-w-full overflow-x-hidden bg-black py-16 text-white"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-12">
                <div class="space-y-8 lg:col-span-7">
                    <div>
                        <div class="flex items-center">
                            <ThreeStars />
                        </div>
                        <h2 class="mb-6 text-4xl font-bold md:text-5xl">
                            Our Journey
                        </h2>
                        <p class="leading-relaxed text-gray-400">
                            Our story is one of continuous growth and evolution.
                            We started as a small team with big dreams,
                            determined to create a real estate platform that
                            transcended the ordinary. Over the years, we've
                            expanded our reach, forged valuable partnerships,
                            and gained the trust of countless clients.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <JourneyCard
                            v-for="card in cards"
                            :key="card.id"
                            :card="card"
                        />
                    </div>
                </div>

                <House />
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import House from '@/Components/About/Journey/House.vue';
import JourneyCard from '@/Components/About/Journey/JourneyCard.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { JourneyCardInterface } from '@/Types/App/Interfaces';

const cards: JourneyCardInterface[] = [
    {
        id: 1,
        title: '200+',
        subtitle: 'Happy Customers',
    },
    {
        id: 2,
        title: '10K+',
        subtitle: 'Properties For Clients',
    },
    {
        id: 3,
        title: '16+',
        subtitle: 'Years of Experience',
    },
];
</script>
