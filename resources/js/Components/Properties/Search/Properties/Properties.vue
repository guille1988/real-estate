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
                        v-for="property in allProperties"
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
import PropertyController from '@/Routes/actions/App/Http/Controllers/PropertyController';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { ScreenSizeEnum } from '@/Types/App/Enums/ScreenSizeEnum';
import { FilterInterface } from '@/Types/App/Interfaces/FilterInterface';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';
import { IndexPropertyPaginatedInterface } from '@/Types/App/Interfaces/IndexPropertyPaginatedInterface';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces/ScreenSizeConfigInterface';
import { router } from '@inertiajs/vue3';
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
    properties,
    filters,
}: { properties: IndexPropertyPaginatedInterface; filters?: FilterInterface } =
    defineProps<{
        properties: IndexPropertyPaginatedInterface;
        filters?: FilterInterface;
    }>();

const sliderTrack: Ref<HTMLElement | null> = ref<HTMLElement | null>(null);
const slideItems: Ref<HTMLElement[]> = ref<HTMLElement[]>([]);

const allProperties: Ref<IndexPropertyInterface[]> = ref<
    IndexPropertyInterface[]
>([...properties.data]);
const page: Ref<number> = ref<number>(properties.currentPage);
const total: Ref<number> = ref<number>(properties.total);
const isLoadingNext: Ref<boolean> = ref<boolean>(false);
const loadedPages: Ref<Set<number>> = ref<Set<number>>(
    new Set([properties.currentPage]),
);

const currentIndex: Ref<number> = ref<number>(0);
const translateX: Ref<number> = ref<number>(0);
const screenSize: Ref<ScreenSizeEnum> = ref<ScreenSizeEnum>(
    ScreenSizeEnum.DESKTOP,
);
const resizeTimeout: Ref<number | null> = ref<number | null>(null);

const currentVisibleEnd: ComputedRef<number> = computed(
    (): number => currentIndex.value + visibleCards.value,
);

const currentSlides: ComputedRef<string> = computed((): string =>
    Math.min(currentVisibleEnd.value, total.value).toString().padStart(2, '0'),
);

const slidesTotal: ComputedRef<string> = computed((): string =>
    total.value.toString().padStart(2, '0'),
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
    Math.max(0, total.value - visibleCards.value),
);

const canGoBack: ComputedRef<boolean> = computed(
    (): boolean => currentIndex.value > 0,
);
const canGoForward: ComputedRef<boolean> = computed(
    (): boolean => currentIndex.value < maxIndex.value,
);

const mustLoadNextPage = (): boolean => {
    const threshold: number = 10;

    return (
        page.value * threshold >= currentVisibleEnd.value &&
        currentVisibleEnd.value % threshold === 0
    );
};

const maybeLoadNextPage = (): void => {
    if (isLoadingNext.value) {
        return;
    }

    if (mustLoadNextPage()) {
        const next: number = page.value + 1;

        if (loadedPages.value.has(next)) {
            return;
        }

        if (allProperties.value.length >= total.value) {
            return;
        }

        const query = { ...(filters as any), page: next } as const;

        router.get(
            PropertyController.index.url({ query }),
            {},
            {
                preserveState: true,
                preserveScroll: true,
                only: ['properties'],
                replace: true,
                onStart: (): void => {
                    isLoadingNext.value = true;
                },
                onFinish: (): void => {
                    isLoadingNext.value = false;
                },
            },
        );
    }
};

const nextSlide = (): void => {
    if (!canGoForward.value) return;
    currentIndex.value = Math.min(currentIndex.value + 1, maxIndex.value);
    updateTranslateX();
    maybeLoadNextPage();
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

const resetStateFromProps = (
    newProps: IndexPropertyPaginatedInterface,
): void => {
    allProperties.value = [...newProps.data];
    page.value = newProps.currentPage;
    total.value = newProps.total;
    loadedPages.value = new Set([1]);
    currentIndex.value = 0;

    nextTick((): void => updateTranslateX());
};

watch(
    () => properties,
    (newProps: IndexPropertyPaginatedInterface): void => {
        if (!newProps) {
            return;
        }
        if (newProps.currentPage === 1) {
            resetStateFromProps(newProps);
            return;
        }

        if (newProps.currentPage > page.value) {
            const existing: Set<string> = new Set(
                allProperties.value.map(
                    (property: IndexPropertyInterface): string => property.uuid,
                ),
            );

            const toAppend: IndexPropertyInterface[] = newProps.data.filter(
                (property: IndexPropertyInterface): boolean =>
                    !existing.has(property.uuid),
            );

            if (toAppend.length > 0) {
                allProperties.value.push(...toAppend);
            }

            page.value = newProps.currentPage;
            total.value = newProps.total;
            loadedPages.value.add(newProps.currentPage);

            nextTick((): void => {
                updateTranslateX();
            });
        }
    },
    { deep: false },
);

watch(
    () => filters,
    (): void => {
        if (properties) {
            resetStateFromProps(properties);
        }
    },
    { deep: true },
);

onMounted((): void => {
    if (page.value !== 1) {
        const query = { ...(filters as any), page: undefined } as const;

        router.get(
            PropertyController.index.url({ query }),
            {},
            {
                preserveState: true,
                preserveScroll: true,
                only: ['properties'],
                replace: true,
            },
        );
    }

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
