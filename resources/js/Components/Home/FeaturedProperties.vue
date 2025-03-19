<template>
    <section class="bg-black py-10 text-white md:py-16">
        <div class="container mx-auto px-4">
            <div
                class="mb-8 flex flex-col gap-6 md:mb-12 md:flex-row md:items-start md:justify-between"
            >
                <div class="max-w-2xl">
                    <div class="mb-4 flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                            />
                        </svg>
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
                    class="self-start whitespace-nowrap rounded-md border border-gray-800 bg-transparent px-4 py-2 text-sm transition hover:bg-gray-800 md:px-6 md:py-3 md:text-base"
                >
                    View All Properties
                </button>
            </div>

            <div
                class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-3"
            >
                <div
                    v-for="property in properties"
                    :key="property.id"
                    class="cursor-pointer overflow-hidden rounded-xl border border-gray-800 bg-gray-900/50 transition-all duration-300 hover:-translate-y-1 hover:border-purple-900/30 hover:shadow-lg hover:shadow-purple-900/20"
                >
                    <div class="relative overflow-hidden">
                        <img
                            :src="property.image"
                            :alt="property.title"
                            class="h-48 w-full object-cover transition-transform duration-700 ease-in-out hover:scale-110 sm:h-56 md:h-64"
                        />

                        <div
                            class="absolute bottom-0 left-0 right-0 bg-black/70 p-2 text-xs"
                        >
                            <p class="text-purple-400">
                                {{ property.category }}
                            </p>
                        </div>
                    </div>
                    <div class="p-4 md:p-6">
                        <h3
                            class="mb-2 text-lg font-semibold transition-colors duration-300 group-hover:text-purple-400 md:text-xl"
                        >
                            {{ property.title }}
                        </h3>
                        <p class="mb-4 text-xs text-gray-400 md:text-sm">
                            {{ property.description }}
                            <button
                                class="ml-1 text-purple-500 transition-colors duration-300 hover:text-purple-400"
                            >
                                Read More
                            </button>
                        </p>

                        <div class="mb-4 flex flex-wrap gap-2 md:mb-6 md:gap-4">
                            <div class="flex items-center gap-1 md:gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-gray-500 md:h-5 md:w-5"
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
                                <span class="text-xs text-gray-400 md:text-sm"
                                    >4-Bedroom</span
                                >
                            </div>
                            <div class="flex items-center gap-1 md:gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-gray-500 md:h-5 md:w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 12h-3m3 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                <span class="text-xs text-gray-400 md:text-sm"
                                    >3-Bathroom</span
                                >
                            </div>
                            <div class="flex items-center gap-1 md:gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-gray-500 md:h-5 md:w-5"
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
                                <span class="text-xs text-gray-400 md:text-sm"
                                    >Villa</span
                                >
                            </div>
                        </div>

                        <div
                            class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
                        >
                            <div>
                                <p class="text-xs text-gray-400">Price</p>
                                <p class="text-lg font-semibold md:text-xl">
                                    ${{ formatPrice(property.price) }}
                                </p>
                            </div>
                            <button
                                @click="openDetails(property.id)"
                                class="w-full rounded-md bg-purple-600 px-4 py-2 text-xs transition-colors duration-300 hover:bg-purple-500 sm:w-auto md:px-6 md:py-3 md:text-sm"
                            >
                                View Property Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-400 md:text-sm">01 of 60</p>
                <div class="flex gap-2">
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 md:h-6 md:w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </button>
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 md:h-6 md:w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';

const properties = [
    {
        id: 1,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        category: 'Coastal Escapes - Where Waves Beckon',
        title: 'Seaside Serenity Villa',
        description:
            'Wake up to the soothing melody of waves. This beachfront villa offers...',
        price: 1250000,
    },
    {
        id: 2,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        category: 'Urban Oasis - Life in the Heart of the City',
        title: 'Metropolitan Haven',
        description:
            'Immerse yourself in the energy of the city. This modern apartment in the heart...',
        price: 650000,
    },
    {
        id: 3,
        image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVhdXRpZnVsJTIwaG91c2V8ZW58MHx8MHx8fDA%3D',
        category: "Countryside Charm - Escape to Nature's Embrace",
        title: 'Rustic Retreat Cottage',
        description:
            'Find tranquility in the countryside. This charming cottage is nestled amidst rolling hills...',
        price: 350000,
    },
];

const formatPrice = (price: number): string => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
};

const openDetails = (id: number): void => {
    router.visit(route('properties.show', { property: id }));
};
</script>
