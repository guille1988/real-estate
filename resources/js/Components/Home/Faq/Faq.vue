<template>
    <section class="bg-black py-10 text-white md:py-16">
        <div class="container mx-auto px-4">
            <div
                class="mb-16 flex flex-col items-start justify-between md:flex-row md:items-center"
            >
                <div class="max-w-4xl">
                    <ThreeStars />
                    <h1 class="mb-4 text-2xl font-bold text-white md:text-3xl">
                        Frequently Asked Questions
                    </h1>
                    <p class="text-sm text-gray-400">
                        Find answers to common questions about Real estate's
                        services, property listings, and the real estate
                        process. We're here to provide clarity and assist you
                        every step of the way.
                    </p>
                </div>
            </div>

            <div class="mb-8 overflow-hidden">
                <div
                    ref="sliderTrack"
                    class="flex transition-transform duration-500 ease-in-out"
                    :style="{ transform: `translateX(-${translateX}px)` }"
                >
                    <div
                        v-for="card in cards"
                        :key="card.id"
                        class="flex-shrink-0 pr-4 md:pr-6"
                        :class="{
                            'w-full': screenSize === ScreenSizeEnum.MOBILE,
                            'w-1/2': screenSize === ScreenSizeEnum.TABLET,
                            'w-1/3': screenSize === ScreenSizeEnum.DESKTOP,
                        }"
                        ref="slideItems"
                    >
                        <FaqCard :card="card" />
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <div class="flex gap-2">
                    <button
                        class="border border-gray-800 p-1.5 transition-colors duration-300 md:p-2"
                        :class="{
                            'hover:bg-gray-800': canGoBack,
                            'cursor-not-allowed opacity-50': !canGoBack,
                        }"
                        @click="prevSlide"
                        :disabled="!canGoBack"
                        aria-label="Previous slide"
                    >
                        <PreviousSliderArrowIcon />
                    </button>
                    <button
                        class="border border-gray-800 p-1.5 transition-colors duration-300 md:p-2"
                        :class="{
                            'hover:bg-gray-800': canGoForward,
                            'cursor-not-allowed opacity-50': !canGoForward,
                        }"
                        @click="nextSlide"
                        :disabled="!canGoForward"
                        aria-label="Next slide"
                    >
                        <NextSliderArrowIcon />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import FaqCard from '@/Components/Home/Faq/FaqCard.vue';
import NextSliderArrowIcon from '@/Components/Shared/SliderArrows/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Shared/SliderArrows/PreviousSliderArrowIcon.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { ScreenSizeEnum } from '@/Types/App/Enums';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces';
import {
    computed,
    ComputedRef,
    nextTick,
    onMounted,
    onUnmounted,
    Ref,
    ref,
    watch,
} from 'vue';

import { FaqCardInterface } from '@/Types/App/Interfaces';

const cards: FaqCardInterface[] = [
    {
        id: 1,
        title: 'How do I search for properties on Real estate?',
        description:
            'Learn how to use our user-friendly search tools to find properties that match your criteria.',
    },
    {
        id: 2,
        title: 'What documents do I need to sell my property through Real estate?',
        description:
            'Find out about the necessary documentation for listing your property with us.',
    },
    {
        id: 3,
        title: 'How can I contact an Real estate agent?',
        description:
            'Discover the different ways you can get in touch with our experienced agents.',
    },
    {
        id: 4,
        title: 'What are the benefits of working with Real estate?',
        description:
            'Learn about the advantages of choosing our agency for your real estate needs.',
    },
    {
        id: 5,
        title: 'How does the property buying process work?',
        description:
            'Get a step-by-step overview of the property buying journey with Real estate.',
    },
    {
        id: 6,
        title: 'What financing options are available for buyers?',
        description:
            'Explore the various financing solutions we can help you access for your property purchase.',
    },
];

const sliderTrack: Ref<HTMLElement | null> = ref(null);
const slideItems: Ref<HTMLElement[]> = ref([]);

const currentIndex: Ref<number> = ref(0);
const translateX: Ref<number> = ref(0);
const screenSize: Ref<ScreenSizeEnum> = ref(ScreenSizeEnum.DESKTOP);
const resizeTimeout: Ref<number | null> = ref(null);

const visibleCards: ComputedRef<number> = computed((): number => {
    const cards: Record<ScreenSizeEnum, number> = {
        [ScreenSizeEnum.MOBILE]: 1,
        [ScreenSizeEnum.TABLET]: 2,
        [ScreenSizeEnum.DESKTOP]: 3,
    };

    return cards[screenSize.value] ?? 3;
});

const maxIndex: ComputedRef<number> = computed((): number =>
    Math.max(0, cards.length - visibleCards.value),
);

const canGoBack: ComputedRef<boolean> = computed(
    (): boolean => currentIndex.value > 0,
);
const canGoForward: ComputedRef<boolean> = computed(
    (): boolean => currentIndex.value < maxIndex.value,
);

const nextSlide = (): void => {
    if (!canGoForward.value) return;
    currentIndex.value = Math.min(currentIndex.value + 1, maxIndex.value);
    updateTranslateX();
};

const prevSlide = (): void => {
    if (!canGoBack.value) return;
    currentIndex.value = Math.max(currentIndex.value - 1, 0);
    updateTranslateX();
};

const updateTranslateX = (): void => {
    if (!sliderTrack.value || !slideItems.value.length) return;

    if (currentIndex.value === 0) {
        translateX.value = 0;
        return;
    }

    const containerWidth: number =
        sliderTrack.value.parentElement?.clientWidth || 0;
    const cardWidth: number = containerWidth / visibleCards.value;

    translateX.value = cardWidth * currentIndex.value;
};

const updateScreenSize = (): void => {
    const screenSizes: ScreenSizeConfigInterface[] = [
        { max: 768, type: ScreenSizeEnum.MOBILE },
        { max: 1024, type: ScreenSizeEnum.TABLET },
    ];

    const width: number = window.innerWidth;
    const match: ScreenSizeConfigInterface | undefined = screenSizes.find(
        (screenSizeConfig: ScreenSizeConfigInterface) =>
            width < screenSizeConfig.max,
    );

    screenSize.value =
        match === undefined ? ScreenSizeEnum.DESKTOP : match.type;

    currentIndex.value = Math.min(currentIndex.value, maxIndex.value);

    nextTick((): void => {
        updateTranslateX();
    });
};

const handleResize = () => {
    if (resizeTimeout.value !== null) {
        window.clearTimeout(resizeTimeout.value);
    }

    resizeTimeout.value = window.setTimeout((): void => {
        updateScreenSize();
    }, 200);
};

watch(screenSize, (): void => {
    updateTranslateX();
});

onMounted((): void => {
    updateScreenSize();
    window.addEventListener('resize', handleResize);
});

onUnmounted((): void => {
    if (resizeTimeout.value !== null) {
        window.clearTimeout(resizeTimeout.value);
    }

    window.removeEventListener('resize', handleResize);
});
</script>
