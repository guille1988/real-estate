<template>
    <section class="w-full bg-black py-16" id="explore-real-state">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 gap-4">
                <ExploreCard
                    v-for="card in cards"
                    :key="card.id"
                    :card="card"
                />

                <div class="flex h-64 space-x-4 sm:h-72">
                    <div class="flex-1 overflow-hidden rounded-lg">
                        <img
                            :src="TeamManPortrait"
                            alt="Team Man Portrait"
                            class="h-full w-full object-cover"
                        />
                    </div>

                    <div class="flex-1 overflow-hidden rounded-lg">
                        <img
                            :src="TeamWomanPortrait"
                            alt="Team Woman Portrait"
                            class="h-full w-full object-cover"
                        />
                    </div>
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

                <div class="h-64 overflow-hidden rounded-lg sm:h-72">
                    <img
                        :src="Handshake"
                        alt="Handshake"
                        class="h-full w-full object-cover"
                    />
                </div>
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
    },
    {
        id: 2,
        image: Team,
        alt: 'Professional Team',
    },
    {
        id: 3,
        image: WorkingTeam,
        alt: 'Team Working',
    },
];
</script>
