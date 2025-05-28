<template>
    <section class="relative overflow-hidden bg-black text-white">
        <div class="container mx-auto px-4 py-6 lg:py-8">
            <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-2">
                <div>
                    <h1
                        class="mb-4 text-4xl font-bold leading-tight md:text-5xl lg:text-6xl"
                    >
                        Discover Your Dream Property with Real estate
                    </h1>
                    <p class="mb-6 max-w-lg text-gray-300">
                        Your journey to finding the perfect property begins
                        here. Explore our listings to find the home that matches
                        your dreams.
                    </p>

                    <div class="mb-10 flex flex-wrap gap-4">
                        <button
                            class="rounded-md border border-gray-600 px-6 py-3 transition hover:bg-gray-800"
                        >
                            Learn More
                        </button>
                        <button
                            class="rounded-md bg-purple-600 px-6 py-3 transition hover:bg-purple-700"
                        >
                            Browse Properties
                        </button>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <StatsCard
                            v-for="statCard in statCards"
                            :card="statCard"
                            :key="statCard.id"
                        />
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <img
                        :src="BlueBuilding"
                        alt="Modern blue building"
                        class="h-auto w-full object-contain"
                    />
                </div>
            </div>

            <div
                class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4"
            >
                <HeroSectionCard
                    v-for="heroCard in heroCards"
                    :key="heroCard.id"
                    :card="heroCard"
                />
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import BlueBuilding from '@/Assets/Images/blue_building.png';
import HeroSectionCard from '@/Components/Home/HeroSection/HeroSectionCard/HeroSectionCard.vue';
import StatsCard from '@/Components/Home/HeroSection/StatsCard.vue';
import PropertyController from '@/Routes/actions/App/Http/Controllers/PropertyController';
import ServiceController from '@/Routes/actions/App/Http/Controllers/ServiceController';
import {
    HeroSectionCardInterface,
    StatCardInterface,
} from '@/Types/App/Interfaces';

const statCards: StatCardInterface[] = [
    {
        id: 1,
        stat: '100+',
        description: 'Happy Customers',
    },
    {
        id: 2,
        stat: '10k+',
        description: 'Properties For Clients',
    },
    {
        id: 3,
        stat: '16+',
        description: 'Years Of Experience',
    },
];

const heroCards: HeroSectionCardInterface[] = [
    {
        id: 1,
        url: PropertyController.index().url,
        icon: 'HouseIcon',
        description: 'Find Your Dream Home',
    },
    {
        id: 2,
        url: ServiceController().url,
        icon: 'ScaleIcon',
        description: 'Unlock Property Value',
    },
    {
        id: 3,
        url: ServiceController().url,
        icon: 'BuildingIcon',
        description: 'Effortless Property Management',
    },
    {
        id: 4,
        url: ServiceController().url,
        icon: 'LampIcon',
        description: 'Smart Investments, Informed Decisions',
    },
];
</script>
