<template>
    <section
        class="w-full bg-black py-8 text-white"
        id="effortless-property-management"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-16 max-w-3xl">
                <ThreeStars />
                <h2 class="mb-4 text-3xl font-medium">
                    Effortless Property Management
                </h2>
                <p class="leading-relaxed text-gray-400">
                    Owning a property should be a pleasure, not a hassle. Real
                    State's Property Management Service takes the stress out of
                    property ownership, offering comprehensive solutions
                    tailored to your needs. Explore the categories below to see
                    how we can make property management effortless for you.
                </p>
            </div>

            <div
                class="mb-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3"
            >
                <EffortlessPropertyManagementCard
                    v-for="card in getFirstThreeCards()"
                    :key="card.id"
                    :card="card"
                />
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <EffortlessPropertyManagementCard :card="getLastCard()" />

                <div
                    class="border border-neutral-800 bg-neutral-900 p-6 md:col-span-2"
                >
                    <div
                        class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between"
                    >
                        <h2
                            class="mb-4 text-2xl font-medium sm:mb-0 lg:text-3xl"
                        >
                            Experience Effortless Property Management
                        </h2>
                        <button
                            class="self-start bg-black px-6 py-3 text-white transition-colors duration-300 sm:self-center"
                        >
                            Learn More
                        </button>
                    </div>

                    <p class="text-gray-400">
                        Ready to experience hassle-free property management?
                        Explore our Property Management Service categories and
                        let us handle the complexities while you enjoy the
                        benefits of property ownership.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import EffortlessPropertyManagementCard from '@/Components/Services/EffortlessPropertyManagement/EffortlessPropertyManagementCard.vue';
import { EffortlessPropertyCardInterface } from '@/Types/App/Interfaces';

const cards: EffortlessPropertyCardInterface[] = [
    {
        id: 1,
        icon: 'GridIcon',
        title: 'Tenant Harmony',
        description:
            'Our Tenant Management services ensure that your tenants have a smooth and reducing vacancies.',
    },
    {
        id: 2,
        icon: 'ChartIcon',
        title: 'Maintenance Ease',
        description:
            'Say goodbye to property maintenance headaches. We handle all aspects of property upkeep.',
    },
    {
        id: 3,
        icon: 'StarIcon',
        title: 'Financial Peace of Mind',
        description:
            'Managing property finances can be complex. Our financial experts take care of rent collection.',
    },
    {
        id: 4,
        icon: 'SunIcon',
        title: 'Legal Guardian',
        description:
            'Stay compliant with property laws and regulations effortlessly.',
    },
];

const getFirstThreeCards = (): EffortlessPropertyCardInterface[] =>
    cards.slice(0, 3);
const getLastCard = (): EffortlessPropertyCardInterface =>
    cards[cards.length - 1];
</script>
