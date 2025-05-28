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
                            Featured Properties
                        </h2>
                    </div>
                    <p class="text-sm text-gray-400 md:text-base">
                        Explore our handpicked selection of featured properties.
                        Each listing offers a glimpse into exceptional homes and
                        investments available through Real estate. Click "View
                        Details" for more information.
                    </p>
                </div>
                <button
                    @click="visit(index().url)"
                    class="self-start whitespace-nowrap rounded-md border border-gray-800 bg-transparent px-4 py-2 text-sm transition hover:bg-gray-800 md:px-6 md:py-3 md:text-base"
                >
                    View All Properties
                </button>
            </div>

            <div
                class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-3"
            >
                <FeaturedPropertyCard
                    v-for="card in cards"
                    :key="card.id"
                    :card="card"
                />
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-400 md:text-sm">01 of 60</p>
                <div class="flex gap-2">
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <PreviousSliderArrowIcon />
                    </button>
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <NextSliderArrowIcon />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import FeaturedPropertyCard from '@/Components/Home/FeaturedProperties/FeaturedPropertyCard/FeaturedPropertyCard.vue';
import NextSliderArrowIcon from '@/Components/Shared/SliderArrows/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Shared/SliderArrows/PreviousSliderArrowIcon.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { index } from '@/Routes/actions/App/Http/Controllers/PropertyController';
import { router } from '@inertiajs/vue3';

const cards = [
    {
        id: 1,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        category: 'Coastal Escapes - Where Waves Beckon',
        title: 'Seaside Serenity Villa',
        description:
            'Wake up to the soothing melody of waves. This beachfront villa offers...',
        price: '$1.250.000',
    },
    {
        id: 2,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        category: 'Urban Oasis - Life in the Heart of the City',
        title: 'Metropolitan Haven',
        description:
            'Immerse yourself in the energy of the city. This modern apartment in the heart...',
        price: '$650.000',
    },
    {
        id: 3,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        category: "Countryside Charm - Escape to Nature's Embrace",
        title: 'Rustic Retreat Cottage',
        description:
            'Find tranquility in the countryside. This charming cottage is nestled amidst rolling hills...',
        price: '$350.000',
    },
];

const visit = (url: string): void => {
    router.visit(url);
};
</script>
