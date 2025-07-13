<template>
    <section class="bg-black py-10 text-white md:py-8" id="featured-properties">
        <div class="container mx-auto px-4">
            <div
                class="mb-8 flex flex-col gap-6 md:mb-12 md:flex-row md:items-start md:justify-between"
            >
                <div class="max-w-2xl">
                    <ThreeStars />
                    <div class="mb-4 flex items-center gap-2">
                        <h2 class="text-2xl font-bold md:text-3xl">
                            Featured Properties
                        </h2>
                    </div>
                    <p class="text-sm text-gray-400 md:text-base">
                        Explore our handpicked selection of featured properties.
                        Each listing offers a glimpse into exceptional homes and
                        investments available through Real estate. Click "View
                        Details" for more information.
                    </p>
                </div>
                <Link prefetch :href="useSection('search-property')">
                    <button
                        class="self-start whitespace-nowrap rounded-md border border-gray-800 bg-transparent px-4 py-2 text-sm transition hover:bg-gray-800 md:px-6 md:py-3 md:text-base"
                    >
                        View All Properties
                    </button>
                </Link>
            </div>

            <div class="mb-8 overflow-hidden">
                <div
                    ref="sliderTrack"
                    class="flex transition-transform duration-500 ease-in-out"
                    :style="{ transform: `translateX(-${translateX}px)` }"
                >
                    <div
                        v-for="card in featuredProperties"
                        :key="card.uuid"
                        class="flex-shrink-0 pr-4 md:pr-6"
                        :class="{
                            'w-full': screenSize === ScreenSizeEnum.MOBILE,
                            'w-1/2': screenSize === ScreenSizeEnum.TABLET,
                            'w-1/3': screenSize === ScreenSizeEnum.DESKTOP,
                        }"
                        ref="slideItems"
                    >
                        <FeaturedPropertyCard :card="card" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-400 md:text-sm">
                    {{ `${currentSlides} of ${slidesTotal}` }}
                </p>
                <div class="flex gap-2">
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 md:p-2"
                        :class="{
                            'hover:bg-gray-800': canGoBack,
                            'cursor-not-allowed opacity-50': !canGoBack,
                        }"
                        @click="prevSlide"
                        :disabled="!canGoBack"
                        aria-label="Previous slide"
                    >
                        <ChevronIcon :direction="ChevronDirectionEnum.LEFT" />
                    </button>
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 md:p-2"
                        :class="{
                            'hover:bg-gray-800': canGoForward,
                            'cursor-not-allowed opacity-50': !canGoForward,
                        }"
                        @click="nextSlide"
                        :disabled="!canGoForward"
                        aria-label="Next slide"
                    >
                        <ChevronIcon :direction="ChevronDirectionEnum.RIGHT" />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import FeaturedPropertyCard from '@/Components/Home/FeaturedProperties/FeaturedPropertyCard.vue';
import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { useSection } from '@/Composables/useSection';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { ScreenSizeEnum } from '@/Types/App/Enums/ScreenSizeEnum';
import { FeaturedPropertyCardInterface } from '@/Types/App/Interfaces/FeaturedPropertyCardInterface';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces/ScreenSizeConfigInterface';
import { Link } from '@inertiajs/vue3';
import {
    computed,
    ComputedRef,
    nextTick,
    onMounted,
    onUnmounted,
    ref,
    Ref,
    watch,
} from 'vue';

const {
    featuredProperties,
}: { featuredProperties: FeaturedPropertyCardInterface[] } = defineProps<{
    featuredProperties: FeaturedPropertyCardInterface[];
}>();

const sliderTrack: Ref<HTMLElement | null> = ref(null);
const slideItems: Ref<HTMLElement[]> = ref([]);

const currentIndex: Ref<number> = ref(0);
const translateX: Ref<number> = ref(0);
const screenSize: Ref<ScreenSizeEnum> = ref(ScreenSizeEnum.DESKTOP);
const resizeTimeout: Ref<number | null> = ref(null);

const currentSlides: ComputedRef<string> = computed((): string =>
    Math.min(currentIndex.value + visibleCards.value, featuredProperties.length)
        .toString()
        .padStart(2, '0'),
);

const slidesTotal: ComputedRef<string> = computed((): string =>
    featuredProperties.length.toString().padStart(2, '0'),
);

const visibleCards: ComputedRef<number> = computed((): number => {
    const cards: Record<ScreenSizeEnum, number> = {
        [ScreenSizeEnum.MOBILE]: 1,
        [ScreenSizeEnum.TABLET]: 2,
        [ScreenSizeEnum.DESKTOP]: 3,
    };

    return cards[screenSize.value] ?? 3;
});

const maxIndex: ComputedRef<number> = computed((): number =>
    Math.max(0, featuredProperties.length - visibleCards.value),
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
