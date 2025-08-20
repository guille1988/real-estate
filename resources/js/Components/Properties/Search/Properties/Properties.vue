<template>
    <section class="bg-black py-10 text-white md:py-10" id="properties">
        <div class="container mx-auto">
            <div class="mb-8 overflow-hidden">
                <div
                    ref="sliderTrack"
                    class="flex transition-transform duration-500 ease-in-out"
                    :style="{ transform: `translateX(-${translateX}px)` }"
                >
                    <div
                        v-for="property in properties.data"
                        :key="property.uuid"
                        class="flex-shrink-0 pr-4 md:pr-6"
                        :class="{
                            'w-full': screenSize === ScreenSizeEnum.MOBILE,
                            'w-1/2': screenSize === ScreenSizeEnum.TABLET,
                            'w-1/3': screenSize === ScreenSizeEnum.DESKTOP,
                        }"
                        ref="slideItems"
                    >
                        <PropertyCard :card="property" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-400 md:text-sm">
                    {{ `${currentSlides} of ${slidesTotal}` }}
                </p>
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
                        <ChevronIcon :direction="ChevronDirectionEnum.LEFT" />
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
                        <ChevronIcon :direction="ChevronDirectionEnum.RIGHT" />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import PropertyCard from '@/Components/Properties/Search/Properties/PropertyCard.vue';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { ScreenSizeEnum } from '@/Types/App/Enums/ScreenSizeEnum';
import { IndexPropertyPaginatedInterface } from '@/Types/App/Interfaces/IndexPropertyPaginatedInterface';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces/ScreenSizeConfigInterface';
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

const { properties }: { properties: IndexPropertyPaginatedInterface } =
    defineProps<{
        properties: IndexPropertyPaginatedInterface;
    }>();

const sliderTrack: Ref<HTMLElement | null> = ref<HTMLElement | null>(null);
const slideItems: Ref<HTMLElement[]> = ref<HTMLElement[]>([]);

const currentIndex: Ref<number> = ref<number>(0);
const translateX: Ref<number> = ref<number>(0);
const screenSize: Ref<ScreenSizeEnum> = ref<ScreenSizeEnum>(
    ScreenSizeEnum.DESKTOP,
);
const resizeTimeout: Ref<number | null> = ref<number | null>(null);

const currentSlides: ComputedRef<string> = computed((): string =>
    Math.min(currentIndex.value + visibleCards.value, properties.total)
        .toString()
        .padStart(2, '0'),
);

const slidesTotal: ComputedRef<string> = computed((): string =>
    properties.total.toString().padStart(2, '0'),
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
    Math.max(0, properties.total - visibleCards.value),
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
