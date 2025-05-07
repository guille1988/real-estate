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
                        @click="setActiveTab(LocationTypeEnum.ALL)"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTabEqualsTo(LocationTypeEnum.ALL)
                                ? 'bg-neutral-800 outline outline-1 outline-black'
                                : 'text-gray-400 hover:text-white',
                        ]"
                    >
                        All
                    </button>
                    <button
                        @click="setActiveTab(LocationTypeEnum.REGIONAL)"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTabEqualsTo(LocationTypeEnum.REGIONAL)
                                ? 'bg-neutral-800 outline outline-1 outline-black'
                                : 'text-gray-400 hover:text-white',
                        ]"
                    >
                        Regional
                    </button>
                    <button
                        @click="setActiveTab(LocationTypeEnum.INTERNATIONAL)"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTabEqualsTo(LocationTypeEnum.INTERNATIONAL)
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
                    <PreviousSlideArrowIcon />
                </button>

                <button
                    v-if="shouldShowArrows"
                    @click="nextSlide"
                    class="absolute right-0 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-neutral-800 p-2 text-white opacity-75 transition-opacity hover:opacity-100 focus:outline-none md:-right-12"
                    aria-label="Next slide"
                >
                    <NextSlideArrowIcon />
                </button>

                <div class="overflow-hidden">
                    <div
                        class="flex transition-transform duration-300 ease-in-out"
                        :style="{
                            transform: `translateX(-${multiplyCurrentSlideBy(100)}%)`,
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
                    v-if="totalSlidesAreGreaterThan(1)"
                    class="mt-6 flex justify-center gap-2"
                >
                    <button
                        v-for="slide in totalSlides"
                        :key="slide - 1"
                        @click="setCurrentSlide(slide - 1)"
                        :class="[
                            'h-2 w-2 rounded-full transition-all',
                            currentSlideEqualsTo(slide - 1)
                                ? 'w-4 bg-purple-600'
                                : 'bg-neutral-700 hover:bg-neutral-500',
                        ]"
                        :aria-label="`Go to slide ${slide}`"
                    ></button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import NextSlideArrowIcon from '@/Components/Contact/OfficeLocations/Icons/NextSlideArrowIcon.vue';
import PreviousSlideArrowIcon from '@/Components/Contact/OfficeLocations/Icons/PreviousSlideArrowIcon.vue';
import OfficeLocationCard from '@/Components/Contact/OfficeLocations/OfficeLocationCard.vue';
import { LocationTypeEnum } from '@/Types/App/Enums';
import { OfficeLocationCardInterface } from '@/Types/App/Interfaces';
import { computed, ComputedRef, Ref, ref, watch } from 'vue';

const cards: OfficeLocationCardInterface[] = [
    {
        id: 1,
        location_type: LocationTypeEnum.REGIONAL,
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
        location_type: LocationTypeEnum.REGIONAL,
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
        location_type: LocationTypeEnum.INTERNATIONAL,
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

const activeTab: Ref<string> = ref(LocationTypeEnum.ALL);
const currentSlide: Ref<number> = ref(0);

const activeTabEqualsTo = (tab: LocationTypeEnum): boolean =>
    activeTab.value === tab;

const setActiveTab = (tab: LocationTypeEnum): void => {
    activeTab.value = tab;
};

const currentSlideEqualsTo = (slide: number): boolean =>
    currentSlide.value === slide;

const currentSlideIsGreaterThan = (slide: number): boolean =>
    currentSlide.value > slide;

const currentSlideIsLessThan = (slide: number): boolean =>
    currentSlide.value < slide;

const setCurrentSlide = (slide: number): void => {
    currentSlide.value = slide;
};

const incrementCurrentSlide = (): void => {
    currentSlide.value++;
};

const decrementCurrentSlide = (): void => {
    currentSlide.value--;
};

const multiplyCurrentSlideBy = (multiplier: number): number =>
    currentSlide.value * multiplier;

const filteredCards: ComputedRef<OfficeLocationCardInterface[]> = computed(
    (): OfficeLocationCardInterface[] =>
        activeTabEqualsTo(LocationTypeEnum.ALL)
            ? cards
            : cards.filter((card: OfficeLocationCardInterface) =>
                  activeTabEqualsTo(card.location_type),
              ),
);

const filteredCardsAreGreaterThan = (quantity: number): boolean =>
    filteredCards.value.length > quantity;

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

const totalSlidesAreGreaterThan = (slide: number): boolean =>
    totalSlides.value > slide;

const shouldShowArrows: ComputedRef<boolean> = computed((): boolean =>
    filteredCardsAreGreaterThan(2),
);

const nextSlide = (): void => {
    currentSlideIsLessThan(totalSlides.value - 1)
        ? incrementCurrentSlide()
        : setCurrentSlide(0);
};

const prevSlide = (): void => {
    currentSlideIsGreaterThan(0)
        ? decrementCurrentSlide()
        : setCurrentSlide(totalSlides.value - 1);
};

watch(activeTab, (): void => {
    setCurrentSlide(0);
});
</script>
