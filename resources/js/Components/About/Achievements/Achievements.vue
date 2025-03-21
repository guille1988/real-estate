<template>
    <section
        class="w-full max-w-full overflow-x-hidden bg-black py-16 text-white"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12 max-w-3xl md:mb-16">
                <ThreeStars />
                <h2 class="mb-6 text-4xl font-bold md:text-5xl">
                    Our Achievements
                </h2>
                <p class="leading-relaxed text-gray-400">
                    Our story is one of continuous growth and evolution. We
                    started as a small team with big dreams, determined to
                    create a real estate platform that transcended the ordinary.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <Card
                    v-for="card in cards"
                    :key="card.id"
                    :title="card.title"
                    :content="card.content"
                />
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import Card from '@/Components/About/Achievements/Card.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';

const cards = [
    {
        id: 1,
        title: '3+ Years of Excellence',
        content:
            "With over 3 years in the industry, we've amassed a wealth of knowledge and experience, becoming a go-to resource for all things real estate.",
    },
    {
        id: 2,
        title: 'Happy Clients',
        content:
            'Our greatest achievement is the satisfaction of our clients. Their success stories fuel our passion for what we do.',
    },
    {
        id: 3,
        title: 'Industry Recognition',
        content:
            "We've earned the respect of our peers and industry leaders, with accolades and awards that reflect our commitment to excellence.",
    },
];
</script>
