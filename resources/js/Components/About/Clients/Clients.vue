<template>
    <section
        class="w-full max-w-full overflow-x-hidden bg-black py-8 text-white"
        id="clients"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12 max-w-3xl md:mb-16">
                <ThreeStars />
                <h2 class="mb-6 text-2xl font-bold md:text-3xl">
                    Our Valued Clients
                </h2>
                <p class="leading-relaxed text-gray-400">
                    At Real estate, we have had the privilege of working with a
                    diverse range of clients across various industries. Here are
                    some of the clients we've had the pleasure of serving.
                </p>
            </div>

            <div class="mb-8 overflow-hidden">
                <WhenVisible :data="['clients']">
                    <template #fallback>
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                        >
                            <div
                                v-for="skeleton in visibleCards"
                                :key="`clients-skeleton-${skeleton}`"
                                class="flex-shrink-0 pr-6"
                                :class="{
                                    'w-full':
                                        screenSize === ScreenSizeEnum.MOBILE,
                                    'w-1/2':
                                        screenSize === ScreenSizeEnum.TABLET ||
                                        screenSize === ScreenSizeEnum.DESKTOP,
                                }"
                            >
                                <div
                                    class="rounded-lg border border-gray-800 bg-gray-900/50 p-8"
                                >
                                    <div class="mb-6 ml-4">
                                        <div
                                            class="mb-2 h-4 w-16 rounded bg-gray-700/50"
                                        ></div>
                                        <div
                                            class="h-5 w-40 rounded bg-gray-700/40"
                                        ></div>
                                    </div>
                                    <div
                                        class="mb-8 ml-4 grid grid-cols-2 gap-8"
                                    >
                                        <div>
                                            <div
                                                class="mb-2 h-4 w-24 rounded bg-gray-700/50"
                                            ></div>
                                        </div>
                                        <div>
                                            <div
                                                class="mb-2 h-4 w-24 rounded bg-gray-700/50"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="rounded-lg bg-black/50 p-6">
                                        <div
                                            class="mb-3 h-4 w-32 rounded bg-gray-700/40"
                                        ></div>
                                        <div
                                            class="h-4 w-5/6 rounded bg-gray-700/30"
                                        ></div>
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
                                v-for="card in clients"
                                :key="card.uuid"
                                class="flex-shrink-0 pr-6"
                                :class="{
                                    'w-full':
                                        screenSize === ScreenSizeEnum.MOBILE,
                                    'w-1/2':
                                        screenSize === ScreenSizeEnum.TABLET ||
                                        screenSize === ScreenSizeEnum.DESKTOP,
                                }"
                                ref="slideItems"
                            >
                                <ClientCard :card="card" />
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
                        @click="previousSlide"
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
import ClientCard from '@/Components/About/Clients/ClientCard.vue';
import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { ScreenSizeEnum } from '@/Types/App/Enums/ScreenSizeEnum';
import { ClientInterface } from '@/Types/App/Interfaces/ClientInterface';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces/ScreenSizeConfigInterface';
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

const { clients }: { clients: ClientInterface[] } = defineProps<{
    clients: ClientInterface[];
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
        [ScreenSizeEnum.DESKTOP]: 2,
    };

    return cards[screenSize.value] ?? 2;
});

const maxIndex: ComputedRef<number> = computed((): number =>
    Math.max(0, clients.length - visibleCards.value),
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
