<template>
    <section
        class="bg-black py-8 pb-4 text-white md:py-8 md:pb-4"
        id="testimonials"
    >
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
                <WhenVisible :data="['testimonials']">
                    <template #fallback>
                        <div aria-hidden="true">
                            <div
                                class="flex transition-transform duration-500 ease-in-out"
                            >
                                <div
                                    v-for="i in visibleSkeletonCards"
                                    :key="i"
                                    class="flex-shrink-0 pr-4 md:pr-6"
                                    :class="{
                                        'w-full':
                                            screenSize ===
                                            ScreenSizeEnum.MOBILE,
                                        'w-1/2':
                                            screenSize ===
                                            ScreenSizeEnum.TABLET,
                                        'w-1/3':
                                            screenSize ===
                                            ScreenSizeEnum.DESKTOP,
                                    }"
                                >
                                    <div
                                        class="rounded-xl border border-gray-800 bg-gray-900/50 p-6"
                                    >
                                        <div class="mb-4 flex gap-1">
                                            <div
                                                class="h-5 w-5 rounded bg-gray-700/40"
                                            ></div>
                                            <div
                                                class="h-5 w-5 rounded bg-gray-700/40"
                                            ></div>
                                            <div
                                                class="h-5 w-5 rounded bg-gray-700/40"
                                            ></div>
                                            <div
                                                class="h-5 w-5 rounded bg-gray-700/40"
                                            ></div>
                                            <div
                                                class="h-5 w-5 rounded bg-gray-700/40"
                                            ></div>
                                        </div>

                                        <div
                                            class="mb-4 h-6 w-2/3 rounded bg-gray-700/50"
                                        ></div>
                                        <div class="mb-6 space-y-2">
                                            <div
                                                class="h-4 w-full rounded bg-gray-700/30"
                                            ></div>
                                            <div
                                                class="h-4 w-5/6 rounded bg-gray-700/30"
                                            ></div>
                                            <div
                                                class="h-4 w-4/5 rounded bg-gray-700/30"
                                            ></div>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div
                                                class="h-10 w-10 rounded-full bg-gray-700/50"
                                            ></div>
                                            <div>
                                                <div
                                                    class="mb-1 h-4 w-32 rounded bg-gray-700/40"
                                                ></div>
                                                <div
                                                    class="h-3 w-24 rounded bg-gray-700/30"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <Transition
                        appear
                        enter-active-class="transition-opacity duration-200 ease-out"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="transition-opacity duration-200 ease-in"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div
                            ref="sliderTrack"
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="{
                                transform: `translateX(-${translateX}px)`,
                            }"
                        >
                            <div
                                v-for="testimonial in testimonials"
                                :key="testimonial.uuid"
                                class="flex-shrink-0 pr-4 md:pr-6"
                                :class="{
                                    'w-full':
                                        screenSize === ScreenSizeEnum.MOBILE,
                                    'w-1/2':
                                        screenSize === ScreenSizeEnum.TABLET,
                                    'w-1/3':
                                        screenSize === ScreenSizeEnum.DESKTOP,
                                }"
                                ref="slideItems"
                            >
                                <ClientTestimonialCard :card="testimonial" />
                            </div>
                        </div>
                    </Transition>
                </WhenVisible>
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
import ClientTestimonialCard from '@/Components/Home/ClientTestimonials/ClientTestimonialCard.vue';
import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { ScreenSizeEnum } from '@/Types/App/Enums/ScreenSizeEnum';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces/ScreenSizeConfigInterface';
import { TestimonialInterface } from '@/Types/App/Interfaces/TestimonialInterface';
import { WhenVisible } from '@inertiajs/vue3';
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

const { testimonials }: { testimonials: TestimonialInterface[] } = defineProps<{
    testimonials: TestimonialInterface[];
}>();

const sliderTrack: Ref<HTMLElement | null> = ref<HTMLElement | null>(null);
const slideItems: Ref<HTMLElement[]> = ref<HTMLElement[]>([]);

const currentIndex: Ref<number> = ref<number>(0);
const translateX: Ref<number> = ref<number>(0);
const screenSize: Ref<ScreenSizeEnum> = ref<ScreenSizeEnum>(
    ScreenSizeEnum.DESKTOP,
);
const resizeTimeout: Ref<number | null> = ref<number | null>(null);

const visibleCards: ComputedRef<number> = computed((): number => {
    const cards: Record<ScreenSizeEnum, number> = {
        [ScreenSizeEnum.MOBILE]: 1,
        [ScreenSizeEnum.TABLET]: 2,
        [ScreenSizeEnum.DESKTOP]: 3,
    };

    return cards[screenSize.value] ?? 3;
});

const maxIndex: ComputedRef<number> = computed((): number =>
    Math.max(0, testimonials.length - visibleCards.value),
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

const visibleSkeletonCards: ComputedRef<number> = computed((): number => {
    return visibleCards.value;
});

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
