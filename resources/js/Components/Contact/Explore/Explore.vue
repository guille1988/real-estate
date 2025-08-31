<template>
    <section class="w-full bg-black pb-12 pt-16" id="explore-real-state">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <ExploreCard
                    v-for="card in filterCardsById([1, 2, 3])"
                    :key="card.id"
                    :card="card"
                    class="mb-4 md:mb-0"
                />
                <div
                    class="flex h-auto flex-col space-x-0 space-y-4 md:h-64 md:flex-row md:space-x-4 md:space-y-0"
                >
                    <ExploreCard
                        v-for="card in filterCardsById([4, 5])"
                        :key="card.id"
                        :card="card"
                    />
                </div>
                <ExploreCard
                    v-for="card in filterCardsById(6)"
                    :key="card.id"
                    :card="card"
                    class="order-3 md:order-4"
                />
                <div
                    class="order-4 mt-8 flex h-auto flex-col md:order-3 md:h-64"
                >
                    <ThreeStars />

                    <h2
                        class="mt-2 text-2xl font-medium text-white md:text-3xl"
                    >
                        Explore Real estate's World
                    </h2>

                    <p
                        class="mt-8 text-base leading-relaxed text-gray-400 md:text-lg"
                    >
                        Step inside the world of Real estate, where
                        professionalism meets warmth, and expertise meets
                        passion. Our gallery offers a glimpse into our team and
                        workspaces, inviting you to get to know us better.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import ExploreCard from '@/Components/Contact/Explore/ExploreCard.vue';
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { ContactAssetsInterface } from '@/Types/App/Interfaces/ContactAssetsInterface';
import { ExploreCardInterface } from '@/Types/App/Interfaces/ExploreCardInterface';

const { assets }: { assets: ContactAssetsInterface } = defineProps<{
    assets: ContactAssetsInterface;
}>();

const cards: ExploreCardInterface[] = [
    {
        id: 1,
        image: assets.office,
        alt: 'Real estate Office',
        isSplit: false,
    },
    {
        id: 2,
        image: assets.team,
        alt: 'Professional Team',
        isSplit: false,
    },
    {
        id: 3,
        image: assets.workingTeam,
        alt: 'Team Working',
        isSplit: false,
    },
    {
        id: 4,
        image: assets.teamManPortrait,
        alt: 'Team Man Portrait',
        isSplit: true,
    },
    {
        id: 5,
        image: assets.teamWomanPortrait,
        alt: 'Team Woman Portrait',
        isSplit: true,
    },
    {
        id: 6,
        image: assets.handshake,
        alt: 'Handshake',
        isSplit: false,
    },
];

const filterCardsById = (ids: number | Array<number>): ExploreCardInterface[] =>
    cards.filter((card: ExploreCardInterface) =>
        Array.isArray(ids) ? ids.includes(card.id) : card.id === ids,
    );
</script>
