<template>
    <section
        class="w-full max-w-full overflow-x-hidden bg-black py-8 text-white"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12 max-w-3xl md:mb-16">
                <ThreeStars />
                <h2 class="mb-6 text-4xl font-bold md:text-5xl">
                    Meet the Real estate Team
                </h2>
                <p class="leading-relaxed text-gray-400">
                    At Real estate, our success is driven by the dedication and
                    expertise of our team. Get to know the people behind our
                    mission to make your real estate dreams a reality.
                </p>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <MemberCard v-for="card in cards" :key="card.id" :card="card" />
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import DavidBrown from '@/Assets/Images/david_brown.jpg';
import MaxMitchell from '@/Assets/Images/max_mitchell.jpg';
import MichaelTurner from '@/Assets/Images/michael_turner.jpg';
import SarahJohnson from '@/Assets/Images/sarah_johnson.jpg';
import MemberCard from '@/Components/About/MeetTeam/MemberCard.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { MemberCardInterface } from '@/Types/App/Interfaces';

const cards: MemberCardInterface[] = [
    {
        id: 1,
        name: 'Max Mitchell',
        position: 'Founder',
        image: MaxMitchell,
    },
    {
        id: 2,
        name: 'Sarah Johnson',
        position: 'Chief Real Estate Officer',
        image: SarahJohnson,
    },
    {
        id: 3,
        name: 'David Brown',
        position: 'Head of Property Management',
        image: DavidBrown,
    },
    {
        id: 4,
        name: 'Michael Turner',
        position: 'Legal Counsel',
        image: MichaelTurner,
    },
];
</script>
