<template>
    <section class="bg-black py-10 text-white md:py-16">
        <div class="container mx-auto px-4">
            <div
                class="mb-8 flex flex-col gap-6 md:mb-12 md:flex-row md:items-start md:justify-between"
            >
                <div class="max-w-2xl">
                    <ThreeStars />
                    <div class="mb-4 flex items-center gap-2">
                        <h2 class="text-2xl font-bold md:text-3xl">
                            What Our Clients Say
                        </h2>
                    </div>

                    <p
                        class="whitespace-normal text-sm text-gray-400 md:text-base lg:whitespace-nowrap"
                    >
                        Read the success stories and heartfelt testimonials from
                        our valued clients. Discover why they chose Real estate
                        for their real estate needs.
                    </p>
                </div>
            </div>

            <div
                class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 lg:grid-cols-3"
            >
                <ClientTestimonialCard
                    v-for="card in cards"
                    :key="card.id"
                    :card="card"
                />
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-400 md:text-sm">01 of 10</p>
                <div class="flex gap-2">
                    <button
                        class="border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <PreviousSliderArrowIcon />
                    </button>
                    <button
                        class="border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <NextSliderArrowIcon />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import EmelieThompson from '@/Assets/Images/emelie_thmpson.jpg';
import JohnMans from '@/Assets/Images/john_mans.jpg';
import WadeWarren from '@/Assets/Images/wade_warren.jpg';
import ClientTestimonialCard from '@/Components/Home/ClientTestimonials/ClientTestimonialCard/ClientTestimonialCard.vue';
import NextSliderArrowIcon from '@/Components/Shared/SliderArrows/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Shared/SliderArrows/PreviousSliderArrowIcon.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { ClientTestimonialCardInterface } from '@/Types/App/Interfaces';

const cards: ClientTestimonialCardInterface[] = [
    {
        id: 1,
        title: 'Exceptional Service!',
        description:
            "Our experience with Real estate was outstanding. Their team's dedication and professionalism made finding our dream home a breeze. Highly recommended!",
        name: 'Wade Warren',
        location: 'USA, California',
        thumbnail: WadeWarren,
    },
    {
        id: 2,
        title: 'Efficient and Reliable',
        description:
            "Real estate provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn't be happier with the results.",
        name: 'Emelie Thompson',
        location: 'USA, Florida',
        thumbnail: EmelieThompson,
    },
    {
        id: 3,
        title: 'Trusted Advisors',
        description:
            'The Real estate team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive. Thank you for your support!',
        name: 'John Mans',
        location: 'USA, Nevada',
        thumbnail: JohnMans,
    },
];
</script>
