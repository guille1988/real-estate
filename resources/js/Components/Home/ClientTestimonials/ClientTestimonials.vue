<template>
    <section class="bg-black py-8 pb-4 text-white md:py-8 md:pb-4">
        <div class="container mx-auto px-4">
            <div
                class="mb-8 flex flex-col gap-6 md:mb-12 md:flex-row md:items-start md:justify-between"
            >
                <div class="max-w-2xl">
                    <ThreeStars />
                    <div class="mb-4 flex items-center gap-2">
                        <h2 class="text-2xl font-bold md:text-3xl">
                            What Our Clients Say
                        </h2>
                    </div>

                    <p
                        class="whitespace-normal text-sm text-gray-400 md:text-base lg:whitespace-nowrap"
                    >
                        Read the success stories and heartfelt testimonials from
                        our valued clients. Discover why they chose Real estate
                        for their real estate needs.
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
                        <ClientTestimonialCard :card="card" />
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
import EmelieThompson from '@/Assets/Images/emelie_thmpson.jpg';
import JohnMans from '@/Assets/Images/john_mans.jpg';
import WadeWarren from '@/Assets/Images/wade_warren.jpg';
import ClientTestimonialCard from '@/Components/Home/ClientTestimonials/ClientTestimonialCard/ClientTestimonialCard.vue';
import NextSliderArrowIcon from '@/Components/Shared/SliderArrows/NextSliderArrowIcon.vue';
import PreviousSliderArrowIcon from '@/Components/Shared/SliderArrows/PreviousSliderArrowIcon.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { ScreenSizeEnum } from '@/Types/App/Enums';
import {
    ClientTestimonialCardInterface,
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

const cards: ClientTestimonialCardInterface[] = [
    {
        id: 1,
        title: 'Exceptional Service!',
        description:
            "Our experience with Real estate was outstanding. Their team's dedication and professionalism made finding our dream home a breeze. Highly recommended!",
        name: 'Wade Warren',
        location: 'USA, California',
        thumbnail: WadeWarren,
    },
    {
        id: 2,
        title: 'Efficient and Reliable',
        description:
            "Real estate provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn't be happier with the results.",
        name: 'Emelie Thompson',
        location: 'USA, Florida',
        thumbnail: EmelieThompson,
    },
    {
        id: 3,
        title: 'Trusted Advisors',
        description:
            'The Real estate team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive. Thank you for your support!',
        name: 'John Mans',
        location: 'USA, Nevada',
        thumbnail: JohnMans,
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
