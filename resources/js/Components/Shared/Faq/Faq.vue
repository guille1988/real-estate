<template>
    <section class="bg-black py-8 pb-2 text-white md:py-8 md:pb-2" id="faq">
        <div class="container mx-auto px-4">
            <div
                class="mb-8 flex flex-col items-start justify-between md:mb-12 md:flex-row md:items-center"
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
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
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

import ChevronIcon from '@/Components/Icons/ChevronIcon.vue';
import FaqCard from '@/Components/Shared/Faq/FaqCard.vue';
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';
import { ScreenSizeEnum } from '@/Types/App/Enums/ScreenSizeEnum';
import { FaqCardInterface } from '@/Types/App/Interfaces/FaqCardInterface';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces/ScreenSizeConfigInterface';

const cards: FaqCardInterface[] = [
    {
        id: 1,
        title: 'How do I search for properties on Real estate?',
        description:
            'Learn how to use our user-friendly search tools to find properties that match your criteria.',
        modalItems: [
            {
                id: 1,
                subtitle: 'How do I search for properties on Real estate?',
                paragraphs: [
                    'Our website features a user-friendly search tool that allows you to find properties based on various criteria such as location, price range, property type, and specific features. Simply navigate to the search bar at the top of our homepage and enter your preferences.',
                    'You can also use our advanced search options to refine your results further. Our map view feature enables you to explore properties in specific neighborhoods or areas of interest. Save your favorite searches to receive notifications when new properties matching your criteria become available.',
                ],
            },
        ],
    },
    {
        id: 2,
        title: 'What documents do I need to sell my property through Real estate?',
        description:
            'Find out about the necessary documentation for listing your property with us.',
        modalItems: [
            {
                id: 1,
                subtitle:
                    'What documents do I need to sell my property through Real estate?',
                paragraphs: [
                    "When listing your property with Real estate, you'll need to provide several important documents to ensure a smooth selling process. These typically include proof of ownership (such as your property deed or title), recent property tax statements, and any homeowners association documents if applicable.",
                    "You'll also need to disclose any known issues with the property, provide information about recent renovations or improvements, and share utility bills to give potential buyers an idea of ongoing costs. Our agents will guide you through the specific documentation requirements based on your property type and location.",
                ],
            },
        ],
    },
    {
        id: 3,
        title: 'How can I contact an Real estate agent?',
        description:
            'Discover the different ways you can get in touch with our experienced agents.',
        modalItems: [
            {
                id: 1,
                subtitle: 'How can I contact an Real estate agent?',
                paragraphs: [
                    'There are several convenient ways to connect with our experienced agents. You can call our main office at the number listed in the contact section of our website, or use our online contact form to request a callback at your preferred time.',
                    'Each of our property listings includes the direct contact information for the listing agent, allowing you to reach out to them specifically about properties that interest you. You can also visit one of our office locations in person during business hours to speak with an available agent.',
                    'For immediate assistance, our live chat feature on the website connects you with an agent who can answer your questions in real-time.',
                ],
            },
        ],
    },
    {
        id: 4,
        title: 'What are the benefits of working with Real estate?',
        description:
            'Learn about the advantages of choosing our agency for your real estate needs.',
        modalItems: [
            {
                id: 1,
                subtitle: 'What are the benefits of working with Real estate?',
                paragraphs: [
                    "Choosing Real estate offers numerous advantages for your real estate journey. Our team of experienced agents brings deep market knowledge and negotiation expertise to help you achieve the best possible outcome, whether you're buying or selling.",
                    "We provide comprehensive marketing strategies for sellers, including professional photography, virtual tours, and targeted digital advertising to maximize your property's exposure. For buyers, we offer personalized property searches, private viewings, and guidance throughout the entire purchasing process.",
                    'Our clients also benefit from our extensive network of industry professionals, including mortgage brokers, home inspectors, and legal advisors, ensuring a smooth transaction from start to finish.',
                ],
            },
        ],
    },
    {
        id: 5,
        title: 'How does the property buying process work?',
        description:
            'Get a step-by-step overview of the property buying journey with Real estate.',
        modalItems: [
            {
                id: 1,
                subtitle: 'How does the property buying process work?',
                paragraphs: [
                    "The property buying journey with Real estate begins with an initial consultation to understand your needs and budget. We'll help you secure financing pre-approval if needed, then begin searching for properties that match your criteria.",
                    "Once you've found a property you love, we'll assist you in preparing and submitting a competitive offer. If accepted, we'll guide you through the due diligence process, including property inspections and title searches.",
                    "Our team will help coordinate with mortgage lenders, attorneys, and other parties to ensure a smooth closing process. We'll be with you for the final walkthrough and closing day, making sure everything goes according to plan as you receive the keys to your new property.",
                ],
            },
        ],
    },
    {
        id: 6,
        title: 'What financing options are available for buyers?',
        description:
            'Explore the various financing solutions we can help you access for your property purchase.',
        modalItems: [
            {
                id: 1,
                subtitle: 'What financing options are available for buyers?',
                paragraphs: [
                    'Real estate works with a variety of lenders to help you access numerous financing solutions. Conventional mortgages are popular options with competitive interest rates for buyers with good credit scores. FHA loans offer lower down payment requirements, making homeownership more accessible for first-time buyers.',
                    'VA loans provide excellent terms for veterans and active military personnel, often with no down payment required. For luxury properties, jumbo loans exceed conventional loan limits to accommodate higher purchase prices.',
                    'We can also connect you with lenders offering specialized programs such as construction loans for building new homes, renovation loans for properties needing improvements, and various first-time homebuyer assistance programs that may include down payment assistance or favorable terms.',
                ],
            },
        ],
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
