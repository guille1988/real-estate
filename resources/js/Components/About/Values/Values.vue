<template>
    <section
        class="w-full max-w-full overflow-x-hidden bg-black py-16 text-white"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="flex flex-col gap-8 lg:flex-row lg:gap-16">
                <div class="lg:w-1/3">
                    <ThreeStars />
                    <h2 class="mb-6 text-4xl font-bold md:text-5xl">
                        Our Values
                    </h2>
                    <p class="leading-relaxed text-gray-400">
                        Our story is one of continuous growth and evolution. We
                        started as a small team with big dreams, determined to
                        create a real estate platform that transcended the
                        ordinary.
                    </p>
                </div>

                <div class="lg:w-2/3">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <ValueCard
                            v-for="card in cards"
                            :key="card.id"
                            :card="card"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import GraduationHatIcon from '@/Components/About/Values/GraduationHatIcon.vue';
import PadlockIcon from '@/Components/About/Values/PadlockIcon.vue';
import PeopleIcon from '@/Components/About/Values/PeopleIcon.vue';
import StarIcon from '@/Components/About/Values/StarIcon.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { ValueCardInterface } from '@/Types/App/Interfaces';
import ValueCard from './ValueCard.vue';
const cards: ValueCardInterface[] = [
    {
        id: 1,
        icon: PadlockIcon,
        title: 'Trust',
        description:
            'Trust is the cornerstone of every successful real estate transaction.',
    },
    {
        id: 2,
        icon: GraduationHatIcon,
        title: 'Excellence',
        description:
            'We set the bar high for ourselves. From the properties we list to the services we provide.',
    },
    {
        id: 3,
        icon: PeopleIcon,
        title: 'Client-Centric',
        description:
            'Your dreams and needs are at the center of our universe. We listen, understand.',
    },
    {
        id: 4,
        icon: StarIcon,
        title: 'Our Commitment',
        description:
            'We are dedicated to providing you with the highest level of service, professionalism, and support.',
    },
];
</script>
