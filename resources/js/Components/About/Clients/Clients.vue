<template>
    <section
        class="w-full max-w-full overflow-x-hidden bg-black py-16 text-white"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12 max-w-3xl md:mb-16">
                <ThreeStars />
                <h2 class="mb-6 text-4xl font-bold md:text-5xl">
                    Our Valued Clients
                </h2>
                <p class="leading-relaxed text-gray-400">
                    At Real estate, we have had the privilege of working with a
                    diverse range of clients across various industries. Here are
                    some of the clients we've had the pleasure of serving.
                </p>
            </div>

            <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <ClientCard
                    v-for="card in visibleCards"
                    :key="card.id"
                    :card="card"
                />
            </div>

            <div class="flex items-center justify-between">
                <div class="flex gap-4">
                    <button
                        class="rounded-lg bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                        :disabled="currentIndex === 0"
                        :class="{
                            'cursor-not-allowed opacity-50': currentIndex === 0,
                        }"
                        @click="previousSlide"
                    >
                        <PreviousArrowIcon />
                    </button>
                    <button
                        class="rounded-lg bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                        :disabled="currentIndex >= cards.length - 2"
                        :class="{
                            'cursor-not-allowed opacity-50':
                                currentIndex >= cards.length - 2,
                        }"
                        @click="nextSlide"
                    >
                        <NextArrowIcon />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import ClientCard from '@/Components/About/Clients/ClientCard/ClientCard.vue';
import NextArrowIcon from '@/Components/About/Clients/ClientCard/NextArrowIcon.vue';
import PreviousArrowIcon from '@/Components/About/Clients/ClientCard/PreviousArrowIcon.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { ClientCardInterface } from '@/Types/App/Interfaces';
import { computed, Ref, ref } from 'vue';

const cards: ClientCardInterface[] = [
    {
        id: 1,
        url: 'https://www.google.com',
        since: 2019,
        company: 'ABC Corporation',
        domain: 'Commercial Real State',
        category: 'Luxury Home Development',
        what_they_said:
            "Real estate's expertise in finding the perfect office space for our expanding operations was invaluable. They truly understand our business needs.",
    },
    {
        id: 2,
        url: 'https://www.google.com',
        since: 2018,
        company: 'GreenTech Enterprises',
        domain: 'Commercial Real State',
        category: 'Retail Space',
        what_they_said:
            "Real estate's ability to identify prime retail locations helped us expand our brand presence. They are a trusted partner in our growth.",
    },
    {
        id: 3,
        url: 'https://www.google.com',
        since: 2020,
        company: 'TechSolutions Inc',
        domain: 'Commercial Real State',
        category: 'Office Space',
        what_they_said:
            'Working with Real estate has been a game-changer for our business. Their expertise in finding the perfect location for our headquarters was exceptional.',
    },
    {
        id: 4,
        url: 'https://www.google.com',
        since: 2017,
        company: 'Global Ventures',
        domain: 'Residential Real State',
        category: 'Luxury Apartments',
        what_they_said:
            "Real estate's team went above and beyond to understand our specific needs. Their attention to detail and market knowledge is unmatched.",
    },
];

const currentIndex: Ref<number> = ref(0);

const visibleCards = computed((): Array<ClientCardInterface> => {
    return cards.slice(currentIndex.value, currentIndex.value + 2);
});

const nextSlide = (): void => {
    if (currentIndex.value < cards.length - 2) {
        currentIndex.value++;
    }
};

const previousSlide = (): void => {
    if (currentIndex.value > 0) {
        currentIndex.value--;
    }
};
</script>
