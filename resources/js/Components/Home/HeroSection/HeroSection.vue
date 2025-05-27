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
                        :src="blueBuilding"
                        alt="Modern blue building"
                        class="h-auto w-full object-contain"
                    />
                </div>
            </div>

            <div
                class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4"
            >
                <div class="relative rounded-lg bg-gray-900/60 p-6">
                    <div class="mb-12 flex items-start justify-between">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-purple-600 bg-black/60"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-purple-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                />
                            </svg>
                        </div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"
                            />
                        </svg>
                    </div>
                    <h3 class="font-medium">Find Your Dream Home</h3>
                </div>

                <div class="relative rounded-lg bg-gray-900/60 p-6">
                    <div class="mb-12 flex items-start justify-between">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-purple-600 bg-black/60"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-purple-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"
                                />
                            </svg>
                        </div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"
                            />
                        </svg>
                    </div>
                    <h3 class="font-medium">Unlock Property Value</h3>
                </div>

                <div class="relative rounded-lg bg-gray-900/60 p-6">
                    <div class="mb-12 flex items-start justify-between">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-purple-600 bg-black/60"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-purple-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                />
                            </svg>
                        </div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"
                            />
                        </svg>
                    </div>
                    <h3 class="font-medium">Effortless Property Management</h3>
                </div>

                <div class="relative rounded-lg bg-gray-900/60 p-6">
                    <div class="mb-12 flex items-start justify-between">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-purple-600 bg-black/60"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-purple-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"
                                />
                            </svg>
                        </div>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"
                            />
                        </svg>
                    </div>
                    <h3 class="font-medium">
                        Smart Investments, Informed Decisions
                    </h3>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import blueBuilding from '@/Assets/Images/blue_building.png';
import StatsCard from '@/Components/Home/HeroSection/StatsCard.vue';
import { StatCardInterface } from '@/Types/App/Interfaces';

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
</script>
