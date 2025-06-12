<template>
    <section
        class="w-full max-w-full overflow-x-hidden bg-black py-8 text-white"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12 max-w-3xl md:mb-16">
                <ThreeStars />
                <h2 class="mb-6 text-4xl font-bold md:text-5xl">
                    Our Valued Clients
                </h2>
                <p class="leading-relaxed text-gray-400">
                    At Real estate, we have had the privilege of working with a
                    diverse range of clients across various industries. Here are
                    some of the clients we've had the pleasure of serving.
                </p>
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
                        class="flex-shrink-0 pr-6"
                        :class="{
                            'w-full': screenSize === ScreenSizeEnum.MOBILE,
                            'w-1/2':
                                screenSize === ScreenSizeEnum.TABLET ||
                                screenSize === ScreenSizeEnum.DESKTOP,
                        }"
                        ref="slideItems"
                    >
                        <ClientCard :card="card" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex gap-4">
                    <button
                        class="rounded-lg bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                        :disabled="!canGoBack"
                        :class="{
                            'cursor-not-allowed opacity-50': !canGoBack,
                        }"
                        @click="previousSlide"
                    >
                        <PreviousSliderArrowIcon />
                    </button>
                    <button
                        class="rounded-lg bg-gray-800 p-2 transition-colors hover:bg-gray-700"
                        :disabled="!canGoForward"
                        :class="{
                            'cursor-not-allowed opacity-50': !canGoForward,
                        }"
                        @click="nextSlide"
                    >
                        <NextSliderArrowIcon />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import ClientCard from '@/Components/About/Clients/ClientCard.vue';
import NextSliderArrowIcon from '@/Components/Icons/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Icons/PreviousSliderArrowIcon.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { ScreenSizeEnum } from '@/Types/App/Enums';
import {
    ClientCardInterface,
    ScreenSizeConfigInterface,
} from '@/Types/App/Interfaces';
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

const cards: ClientCardInterface[] = [
    {
        id: 1,
        url: 'https://www.google.com',
        since: 2019,
        company: 'ABC Corporation',
        domain: 'Commercial Real State',
        category: 'Luxury Home Development',
        what_they_said:
            "Real estate's expertise in finding the perfect office space for our expanding operations was invaluable. They truly understand our business needs.",
    },
    {
        id: 2,
        url: 'https://www.google.com',
        since: 2018,
        company: 'GreenTech Enterprises',
        domain: 'Commercial Real State',
        category: 'Retail Space',
        what_they_said:
            "Real estate's ability to identify prime retail locations helped us expand our brand presence. They are a trusted partner in our growth.",
    },
    {
        id: 3,
        url: 'https://www.google.com',
        since: 2020,
        company: 'TechSolutions Inc',
        domain: 'Commercial Real State',
        category: 'Office Space',
        what_they_said:
            'Working with Real estate has been a game-changer for our business. Their expertise in finding the perfect location for our headquarters was exceptional.',
    },
    {
        id: 4,
        url: 'https://www.google.com',
        since: 2017,
        company: 'Global Ventures',
        domain: 'Residential Real State',
        category: 'Luxury Apartments',
        what_they_said:
            "Real estate's team went above and beyond to understand our specific needs. Their attention to detail and market knowledge is unmatched.",
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
        [ScreenSizeEnum.DESKTOP]: 2,
    };

    return cards[screenSize.value] ?? 2;
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

const previousSlide = (): void => {
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
