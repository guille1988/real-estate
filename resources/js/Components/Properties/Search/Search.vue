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
                <SearchCard v-for="card in cards" :key="card.id" :card="card" />
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import SearchCard from '@/Components/Properties/Search/SearchCard.vue';
import { SearchCardInterface } from '@/Types/App/Interfaces';

const cards: SearchCardInterface[] = [
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
</script>
