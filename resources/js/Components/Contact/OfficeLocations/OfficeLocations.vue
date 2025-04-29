<template>
    <section class="w-full bg-black py-16 text-white" id="office-locations">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="mb-4 text-3xl font-medium">
                    Discover Our Office Locations
                </h2>
                <p class="w-full text-gray-400">
                    Real estate is here to serve you across multiple locations.
                    Whether you're looking to meet our team, discuss real estate
                    opportunities, or simply drop by for a chat, we have offices
                    conveniently located to serve your needs. Explore the
                    categories below to find the Real estate office nearest to
                    you.
                </p>
            </div>

            <div class="mb-10">
                <div class="inline-flex rounded-md bg-neutral-900/50 p-1">
                    <button
                        @click="activeTab = 'all'"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTab === 'all'
                                ? 'bg-neutral-800 outline outline-1 outline-black'
                                : 'text-gray-400 hover:text-white',
                        ]"
                    >
                        All
                    </button>
                    <button
                        @click="activeTab = 'regional'"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTab === 'regional'
                                ? 'bg-neutral-800 outline outline-1 outline-black'
                                : 'text-gray-400 hover:text-white',
                        ]"
                    >
                        Regional
                    </button>
                    <button
                        @click="activeTab = 'international'"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTab === 'international'
                                ? 'bg-neutral-800 outline outline-1 outline-black'
                                : 'text-gray-400 hover:text-white',
                        ]"
                    >
                        International
                    </button>
                </div>
            </div>

            <div class="relative">
                <button
                    v-if="shouldShowArrows"
                    @click="prevSlide"
                    class="absolute left-0 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-neutral-800 p-2 text-white opacity-75 transition-opacity hover:opacity-100 focus:outline-none md:-left-12"
                    aria-label="Previous slide"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </button>

                <button
                    v-if="shouldShowArrows"
                    @click="nextSlide"
                    class="absolute right-0 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-neutral-800 p-2 text-white opacity-75 transition-opacity hover:opacity-100 focus:outline-none md:-right-12"
                    aria-label="Next slide"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </button>

                <div class="overflow-hidden">
                    <div
                        class="flex transition-transform duration-300 ease-in-out"
                        :style="{
                            transform: `translateX(-${currentSlide * 100}%)`,
                        }"
                    >
                        <div
                            v-for="(slideCards, index) in slides"
                            :key="index"
                            class="flex w-full flex-shrink-0 flex-col gap-8 md:grid md:grid-cols-2"
                        >
                            <OfficeLocationCard
                                v-for="card in slideCards"
                                :key="card.id"
                                :card="card"
                            />
                        </div>
                    </div>
                </div>

                <div
                    v-if="totalSlides > 1"
                    class="mt-6 flex justify-center gap-2"
                >
                    <button
                        v-for="(_, index) in totalSlides"
                        :key="index"
                        @click="goToSlide(index)"
                        :class="[
                            'h-2 w-2 rounded-full transition-all',
                            currentSlide === index
                                ? 'w-4 bg-purple-600'
                                : 'bg-neutral-700 hover:bg-neutral-500',
                        ]"
                        :aria-label="`Go to slide ${index + 1}`"
                    ></button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import OfficeLocationCard from '@/Components/Contact/OfficeLocations/OfficeLocationCard.vue';
import { OfficeLocationCardInterface } from '@/Types/App/Interfaces';
import { computed, ComputedRef, Ref, ref, watch } from 'vue';

const cards: OfficeLocationCardInterface[] = [
    {
        id: 1,
        location_type: 'regional',
        title: 'Main Headquarters',
        address: '123 Real estate Plaza, City Center, Metropolis',
        description:
            'Our main headquarters serve as the heart of Real estate. Located in the bustling city center, this is where our core team of experts operates, driving the excellence and innovation that define us.',
        email: 'main@realestate.com',
        phone: '+1 123 456-7890',
        location: 'Metropolis',
        url: 'https://www.google.com',
    },
    {
        id: 2,
        location_type: 'regional',
        title: 'Regional Offices',
        address: '456 Urban Avenue, Downtown District, Metropolis',
        description:
            "Real estate's presence extends to multiple regions, each with its own dynamic real estate landscape. Discover our regional offices, staffed by local experts who understand the nuances of their respective markets.",
        email: 'regional@realestate.com',
        phone: '+1 123 456-7890',
        location: 'Metropolis',
        url: 'https://www.google.com',
    },
    {
        id: 3,
        location_type: 'international',
        title: 'International Headquarters',
        address: '789 Global Tower, Financial District, London',
        description:
            'Our international headquarters connects Real estate to the global real estate market. Located in the heart of London, this office serves as our gateway to international clients and opportunities.',
        email: 'international@realestate.com',
        phone: '+44 20 1234-5678',
        location: 'London',
        url: 'https://www.google.com',
    },
];

const activeTab: Ref<string> = ref('all');
const currentSlide: Ref<number> = ref(0);

const filteredCards: ComputedRef<OfficeLocationCardInterface[]> = computed(
    (): OfficeLocationCardInterface[] => {
        return activeTab.value === 'all'
            ? cards
            : cards.filter((card) => card.location_type === activeTab.value);
    },
);

const slides: ComputedRef<OfficeLocationCardInterface[][]> = computed(
    (): OfficeLocationCardInterface[][] => {
        const result = [];
        const filtered: OfficeLocationCardInterface[] = filteredCards.value;

        for (let i = 0; i < filtered.length; i += 2) {
            result.push(filtered.slice(i, i + 2));
        }

        return result;
    },
);

const totalSlides: ComputedRef<number> = computed(
    (): number => slides.value.length,
);

const shouldShowArrows: ComputedRef<boolean> = computed(
    (): boolean => filteredCards.value.length > 2,
);

const nextSlide = (): void => {
    if (currentSlide.value < totalSlides.value - 1) {
        currentSlide.value++;
    } else {
        currentSlide.value = 0;
    }
};

const prevSlide = (): void => {
    if (currentSlide.value > 0) {
        currentSlide.value--;
    } else {
        currentSlide.value = totalSlides.value - 1;
    }
};

const goToSlide = (index: number): void => {
    currentSlide.value = index;
};

watch(activeTab, (): void => {
    currentSlide.value = 0;
});
</script>
