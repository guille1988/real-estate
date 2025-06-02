<template>
    <section class="bg-black px-4 py-8">
        <div class="container mx-auto">
            <div class="mb-12 pl-36 text-left">
                <h1 class="mb-4 text-4xl font-bold text-white">
                    Find Your Dream Property
                </h1>
                <p class="ml-0 max-w-6xl text-gray-400">
                    Welcome to Real estate, where your dream property awaits in
                    every corner of our beautiful world. Explore our curated
                    selection of properties, each offering a unique story and a
                    chance to redefine your life. With categories to suit every
                    dreamer, your journey.
                </p>
            </div>

            <div class="mx-auto mb-6 max-w-4xl py-8">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Search For A Property"
                        class="w-full rounded-lg bg-[#111] px-4 py-4 pr-40 text-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600"
                    />
                    <button
                        class="absolute right-2 top-1/2 flex -translate-y-1/2 items-center gap-2 rounded-lg bg-purple-600 px-6 py-3 text-sm font-medium text-white hover:bg-purple-700"
                    >
                        <SearchIcon />
                        <span>Find Property</span>
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
import House from '@/Assets/Images/house.jpg';
import Loft from '@/Assets/Images/loft.jpg';
import Villa from '@/Assets/Images/villa.jpg';
import SearchIcon from '@/Components/Properties/Search/Icons/SearchIcon.vue';
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
        image: Villa,
        caption: 'Coastal Escapes - Where Waves Beckon',
        title: 'Seaside Serenity Villa',
        description:
            'Wake up to the soothing melody of waves. This beachfront villa offers...',
        price: '$1.250.000',
    },
    {
        id: 2,
        image: Loft,
        caption: 'Urban Oasis - Life in the Heart of the City',
        title: 'Metropolitan Haven',
        description:
            'Immerse yourself in the energy of the city. This modern loft in the heart...',
        price: '$650.000',
    },
    {
        id: 3,
        image: House,
        caption: "Countryside Charm - Escape to Nature's Embrace",
        title: 'Rustic Retreat Cottage',
        description:
            'Find tranquility in the countryside. This charming cottage is nestled amidst rolling hills...',
        price: '$350.000',
    },
];
</script>
