<template>
    <section class="bg-black px-4 py-20">
        <div class="container mx-auto">
            <div class="mb-12 text-center">
                <h1 class="mb-4 text-4xl font-bold text-white md:text-5xl">
                    Find Your Dream Property
                </h1>
                <p class="mx-auto max-w-3xl text-gray-400">
                    Welcome to Real estate, where your dream property awaits in
                    every corner of our beautiful world. Explore our curated
                    selection of properties, each offering a unique story and a
                    chance to redefine your life. With categories to suit every
                    dreamer, your journey.
                </p>
            </div>

            <div class="mx-auto mb-6 max-w-3xl">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Search For A Property"
                        class="w-full rounded-lg bg-[#111] px-4 py-3 pr-32 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600"
                    />
                    <button
                        class="absolute right-2 top-1/2 -translate-y-1/2 rounded-lg bg-purple-600 px-6 py-2 text-sm font-medium text-white hover:bg-purple-700"
                    >
                        Find Property
                    </button>
                </div>
            </div>

            <div
                class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5"
            >
                <SearchFilterCard
                    v-for="filterCard in filterCards"
                    :key="filterCard.id"
                    :card="filterCard"
                />
            </div>

            <div
                class="grid grid-cols-1 gap-6 pt-16 md:grid-cols-2 lg:grid-cols-3"
            >
                <SearchCard
                    v-for="searchCard in searchCards"
                    :key="searchCard.id"
                    :card="searchCard"
                />
            </div>

            <div class="mt-8 flex items-center justify-between">
                <span class="text-sm text-gray-400">03 of 60</span>
                <div class="flex gap-2">
                    <button
                        class="rounded-lg border border-gray-800 p-2 text-gray-400 hover:bg-gray-800"
                    >
                        <PreviousSliderArrowIcon />
                    </button>
                    <button
                        class="rounded-lg border border-gray-800 p-2 text-gray-400 hover:bg-gray-800"
                    >
                        <NextSliderArrowIcon />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import SearchCard from '@/Components/Properties/Search/SearchCard.vue';
import SearchFilterCard from '@/Components/Properties/Search/SearchFilterCard.vue';
import NextSliderArrowIcon from '@/Components/Shared/SliderArrows/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Shared/SliderArrows/PreviousSliderArrowIcon.vue';
import {
    SearchCardInterface,
    SearchFilterCardInterface,
} from '@/Types/App/Interfaces';

const filterCards: SearchFilterCardInterface[] = [
    {
        id: 1,
        icon: 'LocationIcon',
        label: 'Location',
    },
    {
        id: 2,
        icon: 'HouseIcon',
        label: 'Property Type',
    },
    {
        id: 3,
        icon: 'MoneyIcon',
        label: 'Pricing Range',
    },
    {
        id: 4,
        icon: 'ChartIcon',
        label: 'Property Size',
    },
    {
        id: 4,
        icon: 'CalendarIcon',
        label: 'Build Year',
    },
];

const searchCards: SearchCardInterface[] = [
    {
        id: 1,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        caption: 'Coastal Escapes - Where Waves Beckon',
        title: 'Seaside Serenity Villa',
        description:
            'Wake up to the soothing melody of waves. This beachfront villa offers...',
        price: '$1.250.000',
    },
    {
        id: 2,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        caption: 'Urban Oasis - Life in the Heart of the City',
        title: 'Metropolitan Haven',
        description:
            'Immerse yourself in the energy of the city. This modern apartment in the heart...',
        price: '$650.000',
    },
    {
        id: 3,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        caption: "Countryside Charm - Escape to Nature's Embrace",
        title: 'Rustic Retreat Cottage',
        description:
            'Find tranquility in the countryside. This charming cottage is nestled amidst rolling hills...',
        price: '$350.000',
    },
];
</script>
