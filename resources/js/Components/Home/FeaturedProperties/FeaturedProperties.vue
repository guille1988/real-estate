<template>
    <section class="bg-black py-10 text-white md:py-8" id="featured-properties">
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
                    @click="router.visit(useSection('search-property'))"
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
                <p class="text-xs text-gray-400 md:text-sm">03 of 60</p>
                <div class="flex gap-2">
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <ChevronIcon :direction="ChevronDirectionEnum.LEFT" />
                    </button>
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <ChevronIcon :direction="ChevronDirectionEnum.RIGHT" />
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
import FeaturedPropertyCard from '@/Components/Home/FeaturedProperties/FeaturedPropertyCard.vue';
import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { useSection } from '@/Composables/useSection';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { FeaturedPropertyCardInterface } from '@/Types/App/Interfaces/FeaturedPropertyCardInterface';
import { router } from '@inertiajs/vue3';

const cards: FeaturedPropertyCardInterface[] = [
    {
        id: 1,
        bedroom_count: 4,
        bathroom_count: 3,
        type: PropertyTypeEnum.VILLA,
        image: Villa,
        caption: 'Coastal Escapes - Where Waves Beckon',
        title: 'Seaside Serenity Villa',
        description:
            'Wake up to the soothing melody of waves. This beachfront villa offers...',
        price: '$1.250.000',
    },
    {
        id: 2,
        bedroom_count: 4,
        bathroom_count: 3,
        type: PropertyTypeEnum.LOFT,
        image: Loft,
        caption: 'Urban Oasis - Life in the Heart of the City',
        title: 'Metropolitan Haven',
        description:
            'Immerse yourself in the energy of the city. This modern loft in the heart...',
        price: '$650.000',
    },
    {
        id: 3,
        bedroom_count: 4,
        bathroom_count: 3,
        type: PropertyTypeEnum.HOUSE,
        image: House,
        caption: "Countryside Charm - Escape to Nature's Embrace",
        title: 'Rustic Retreat Cottage',
        description:
            'Find tranquility in the countryside. This charming cottage is nestled amidst rolling hills...',
        price: '$350.000',
    },
];
</script>
