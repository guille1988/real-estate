<template>
    <section
        class="w-full max-w-full overflow-x-hidden bg-black py-8 text-white"
        id="navigating-experience"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12 max-w-3xl md:mb-16">
                <ThreeStars />
                <h2 class="mb-6 text-2xl font-bold md:text-3xl">
                    Navigating the Real estate Experience
                </h2>
                <p class="leading-relaxed text-gray-400">
                    At Real estate, we've designed a straightforward process to
                    help you find and purchase your dream property with ease.
                    Here's a step-by-step guide to how it all works.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <NavigatingExperienceCard
                    v-for="card in cards"
                    :key="card.id"
                    :card="card"
                />
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import NavigatingExperienceCard from '@/Components/About/NavigatingExperience/NavigatingExperienceCard.vue';
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { NavigatingExperienceCardInterface } from '@/Types/App/Interfaces/NavigatingExperienceCardInterface';

const cards: NavigatingExperienceCardInterface[] = [
    {
        id: 1,
        title: 'Discover a World of Possibilities',
        description:
            'Your journey begins with exploring our carefully curated property listings. Use our intuitive search tools to filter properties based on your preferences, including location, type, size, and budget.',
    },
    {
        id: 2,
        title: 'Narrowing Down Your Choices',
        description:
            "Once you've found properties that catch your eye, save them to your account or make a shortlist. This allows you to compare and revisit your favorites as you make your decision.",
    },
    {
        id: 3,
        title: 'Personalized Guidance',
        description:
            'Have questions about a property or need more information? Our dedicated team of real estate experts is just a call or message away.',
    },
    {
        id: 4,
        title: 'See It for Yourself',
        description:
            "Arrange viewings of the properties you're interested in. We'll coordinate with the property owners and accompany you to ensure you get a firsthand look at your potential new home.",
    },
    {
        id: 5,
        title: 'Making Informed Decisions',
        description:
            'Before making an offer, our team will assist you with due diligence, including property inspections, legal checks, and market analysis. We want you to be fully informed and confident in your choice.',
    },
    {
        id: 6,
        title: 'Getting the Best Deal',
        description:
            "We'll help you negotiate the best terms and prepare your offer. Our goal is to secure the property at the right price and on favorable terms.",
    },
];
</script>
