<template>
    <section class="w-full bg-black py-8 text-white" id="office-locations">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12">
                <ThreeStars />
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
                <div class="overflow-hidden">
                    <div
                        ref="sliderTrack"
                        class="flex transition-transform duration-300 ease-in-out"
                        :style="{ transform: `translateX(-${translateX}px)` }"
                    >
                        <div
                            v-for="card in filteredCards"
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
                            <OfficeLocationCard :card="card" />
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end" v-if="shouldShowArrows">
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
                            <ChevronIcon
                                :direction="ChevronDirectionEnum.LEFT"
                            />
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
                            <ChevronIcon
                                :direction="ChevronDirectionEnum.RIGHT"
                            />
                        </button>
                    </div>
                </div>

                <div
                    v-if="totalSlidesAreGreaterThan(1)"
                    class="mt-6 flex justify-center gap-2"
                >
                    <button
                        v-for="index in maxIndex + 1"
                        :key="index - 1"
                        @click="setCurrentSlide(index - 1)"
                        :class="[
                            'h-2 w-2 rounded-full transition-all',
                            currentIndex === index - 1
                                ? 'w-4 bg-purple-600'
                                : 'bg-neutral-700 hover:bg-neutral-500',
                        ]"
                        :aria-label="`Go to slide ${index}`"
                    ></button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import OfficeLocationCard from '@/Components/Contact/OfficeLocations/OfficeLocationCard.vue';
import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { LocationTypeEnum } from '@/Types/App/Enums/LocationTypeEnum';
import { ScreenSizeEnum } from '@/Types/App/Enums/ScreenSizeEnum';
import { OfficeLocationCardInterface } from '@/Types/App/Interfaces/OfficeLocationCardInterface';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces/ScreenSizeConfigInterface';
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

const cards: OfficeLocationCardInterface[] = [
    {
        id: 1,
        locationType: LocationTypeEnum.REGIONAL,
        title: 'Main Headquarters',
        address: '123 Real estate Plaza, City Center, Metropolis',
        description:
            'Our main headquarters serve as the heart of Real estate. Located in the bustling city center, this is where our core team of experts operates, driving the excellence and innovation that define us.',
        email: 'main@realestate.com',
        phone: '+1 123 456-7890',
        location: 'Metropolis',
        url: 'https://maps.app.goo.gl/WiF8c82wfXatGE7k8',
    },
    {
        id: 2,
        locationType: LocationTypeEnum.REGIONAL,
        title: 'Regional Offices',
        address: '456 Urban Avenue, Downtown District, Metropolis',
        description:
            "Real estate's presence extends to multiple regions, each with its own dynamic real estate landscape. Discover our regional offices, staffed by local experts who understand the nuances of their respective markets.",
        email: 'regional@realestate.com',
        phone: '+1 123 456-7890',
        location: 'Metropolis',
        url: 'https://maps.app.goo.gl/WiF8c82wfXatGE7k8',
    },
    {
        id: 3,
        locationType: LocationTypeEnum.INTERNATIONAL,
        title: 'International Headquarters',
        address: '789 Global Tower, Financial District, London',
        description:
            'Our international headquarters connects Real estate to the global real estate market. Located in the heart of London, this office serves as our gateway to international clients and opportunities.',
        email: 'international@realestate.com',
        phone: '+44 20 1234-5678',
        location: 'London',
        url: 'https://maps.app.goo.gl/WiF8c82wfXatGE7k8',
    },
];

const activeTab: Ref<string> = ref<LocationTypeEnum>(LocationTypeEnum.ALL);

const sliderTrack: Ref<HTMLElement | null> = ref<HTMLElement | null>(null);
const slideItems: Ref<HTMLElement[]> = ref<HTMLElement[]>([]);
const currentIndex: Ref<number> = ref<number>(0);
const translateX: Ref<number> = ref<number>(0);
const screenSize: Ref<ScreenSizeEnum> = ref<ScreenSizeEnum>(
    ScreenSizeEnum.DESKTOP,
);
const resizeTimeout: Ref<number | null> = ref<number | null>(null);

const activeTabEqualsTo = (tab: LocationTypeEnum): boolean =>
    activeTab.value === tab;

const setActiveTab = (tab: LocationTypeEnum): void => {
    activeTab.value = tab;
};

const filteredCards: ComputedRef<OfficeLocationCardInterface[]> = computed(
    (): OfficeLocationCardInterface[] =>
        activeTabEqualsTo(LocationTypeEnum.ALL)
            ? cards
            : cards.filter((card: OfficeLocationCardInterface) =>
                  activeTabEqualsTo(card.locationType),
              ),
);

const visibleCards: ComputedRef<number> = computed((): number => {
    const cards: Record<ScreenSizeEnum, number> = {
        [ScreenSizeEnum.MOBILE]: 1,
        [ScreenSizeEnum.TABLET]: 2,
        [ScreenSizeEnum.DESKTOP]: 2,
    };

    return cards[screenSize.value] ?? 2;
});

const maxIndex: ComputedRef<number> = computed((): number =>
    Math.max(0, filteredCards.value.length - visibleCards.value),
);

const canGoBack: ComputedRef<boolean> = computed(
    (): boolean => currentIndex.value > 0,
);

const canGoForward: ComputedRef<boolean> = computed(
    (): boolean => currentIndex.value < maxIndex.value,
);

const setCurrentSlide = (slide: number): void => {
    currentIndex.value = Math.min(Math.max(0, slide), maxIndex.value);
    updateTranslateX();
};

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

const totalSlidesAreGreaterThan = (slide: number): boolean =>
    maxIndex.value >= slide;

const filteredCardsAreGreaterThan = (quantity: number): boolean =>
    filteredCards.value.length > quantity;

const shouldShowArrows: ComputedRef<boolean> = computed((): boolean =>
    filteredCardsAreGreaterThan(visibleCards.value),
);

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

const handleResize = (): void => {
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

watch(activeTab, (): void => {
    currentIndex.value = 0;
    nextTick(() => {
        updateTranslateX();
    });
});

watch(filteredCards, (): void => {
    currentIndex.value = Math.min(currentIndex.value, maxIndex.value);
    nextTick((): void => {
        updateTranslateX();
    });
});

onMounted((): void => {
    updateScreenSize();
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    if (resizeTimeout.value !== null) {
        window.clearTimeout(resizeTimeout.value);
    }

    window.removeEventListener('resize', handleResize);
});
</script>
