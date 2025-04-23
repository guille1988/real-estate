<template>
    <section class="w-full bg-black py-16" id="explore-real-state">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 gap-4">
                <ExploreCard
                    v-for="card in filterCardsById([1, 2, 3])"
                    :key="card.id"
                    :card="card"
                />

                <div class="flex h-64 space-x-4 sm:h-72">
                    <ExploreCard
                        v-for="card in filterCardsById([4, 5])"
                        :key="card.id"
                        :card="card"
                    />
                </div>

                <div class="mt-8 flex h-64 flex-col sm:h-72">
                    <ThreeStars />

                    <h2 class="mt-8 text-5xl font-medium text-white">
                        Explore Real estate's World
                    </h2>

                    <p class="mt-8 text-lg leading-relaxed text-gray-400">
                        Step inside the world of Real estate, where
                        professionalism meets warmth, and expertise meets
                        passion. Our gallery offers a glimpse into our team and
                        workspaces, inviting you to get to know us better.
                    </p>
                </div>

                <ExploreCard
                    v-for="card in filterCardsById(6)"
                    :key="card.id"
                    :card="card"
                />
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import Handshake from '@/Assets/Images/handshake.png';
import Office from '@/Assets/Images/office.png';
import Team from '@/Assets/Images/team.png';
import TeamManPortrait from '@/Assets/Images/team_man_portrait.png';
import TeamWomanPortrait from '@/Assets/Images/team_woman_portrait.png';
import WorkingTeam from '@/Assets/Images/working_team.png';
import ExploreCard from '@/Components/Contact/Explore/ExploreCard.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { ExploreCardInterface } from '@/Types/App/Interfaces';

const cards: ExploreCardInterface[] = [
    {
        id: 1,
        image: Office,
        alt: 'Real estate Office',
        is_split: false,
    },
    {
        id: 2,
        image: Team,
        alt: 'Professional Team',
        is_split: false,
    },
    {
        id: 3,
        image: WorkingTeam,
        alt: 'Team Working',
        is_split: false,
    },
    {
        id: 4,
        image: TeamManPortrait,
        alt: 'Team Man Portrait',
        is_split: true,
    },
    {
        id: 5,
        image: TeamWomanPortrait,
        alt: 'Team Woman Portrait',
        is_split: true,
    },
    {
        id: 6,
        image: Handshake,
        alt: 'Handshake',
        is_split: false,
    },
];

const filterCardsById = (ids: number | Array<number>): ExploreCardInterface[] =>
    cards.filter((card: ExploreCardInterface) =>
        Array.isArray(ids) ? ids.includes(card.id) : card.id === ids,
    );
</script>
