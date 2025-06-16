<template>
    <section class="w-full bg-black py-16 text-white" id="get-in-touch">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12 max-w-3xl">
                <ThreeStars />
                <h2 class="mb-4 text-3xl font-medium">
                    Get in Touch with Real estate
                </h2>
                <p class="text-gray-400">
                    Welcome to Real estate's Contact Us page. We're here to
                    assist you with any inquiries, requests, or feedback you may
                    have. Whether you're looking to buy or sell a property,
                    explore investment opportunities, or simply want to connect,
                    we're just a message away. Reach out to us, and let's start
                    a conversation.
                </p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <GetInTouchCard
                    v-for="card in cards"
                    :key="card.id"
                    :card="card"
                />
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import GetInTouchCard from '@/Components/Contact/GetInTouch/GetInTouchCard.vue';
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { GetInTouchCardInterface } from '@/Types/App/Interfaces/GetInTouchCardInterface';

const cards: GetInTouchCardInterface[] = [
    {
        id: 1,
        link: 'mailto:info@realestate.com',
        icon: 'EmailIcon',
        label: 'info@realestate.com',
    },
    {
        id: 2,
        link: 'tel:+11234567890',
        icon: 'PhoneIcon',
        label: '+1(123) 456-7890',
    },
    {
        id: 3,
        link: 'https://www.google.com',
        icon: 'LocalizationIcon',
        label: 'Main Headquarters',
    },
    {
        id: 4,
        link: 'https://www.google.com',
        icon: 'LinkedinIcon',
        label: 'LinkedIn',
    },
];
</script>
