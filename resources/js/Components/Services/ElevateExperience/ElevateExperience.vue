<template>
    <section class="w-full bg-black py-8 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12 max-w-3xl">
                <ThreeStars />
                <h2 class="mb-4 text-3xl font-medium">
                    Elevate Your Real Estate Experience
                </h2>
                <p class="text-gray-400">
                    Welcome to Real estate, where your real estate aspirations
                    meet expert guidance. Explore our comprehensive range of
                    services, each designed to cater to your unique needs and
                    dreams.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <ElevateExperienceCard
                    v-for="card in cards"
                    :key="card.id"
                    :card="card"
                />
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import ElevateExperienceCard from '@/Components/Services/ElevateExperience/ElevateExperienceCard.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import PropertyController from '@/Routes/actions/App/Http/Controllers/PropertyController';
import ServiceController from '@/Routes/actions/App/Http/Controllers/ServiceController';
import { HeroSectionCardInterface } from '@/Types/App/Interfaces';

const getServiceSection = (section: string) =>
    ServiceController().url + section;

const cards: HeroSectionCardInterface[] = [
    {
        id: 1,
        url: PropertyController.index().url,
        icon: 'HouseIcon',
        description: 'Find Your Dream Home',
    },
    {
        id: 2,
        url: getServiceSection('#unlock-property-value'),
        icon: 'ScaleIcon',
        description: 'Unlock Property Value',
    },
    {
        id: 3,
        url: getServiceSection('#effortless-property-management'),
        icon: 'BuildingIcon',
        description: 'Effortless Property Management',
    },
    {
        id: 4,
        url: getServiceSection('#smart-investments'),
        icon: 'LampIcon',
        description: 'Smart Investments, Informed Decisions',
    },
];
</script>
