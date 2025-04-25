<template>
    <section class="w-full bg-black py-16 text-white" id="office-locations">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12">
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
                        @click="activeTab = 'all'"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTab === 'all'
                                ? 'bg-neutral-800 outline outline-1 outline-black'
                                : 'text-gray-400 hover:text-white',
                        ]"
                    >
                        All
                    </button>
                    <button
                        @click="activeTab = 'regional'"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTab === 'regional'
                                ? 'bg-neutral-800 outline outline-1 outline-black'
                                : 'text-gray-400 hover:text-white',
                        ]"
                    >
                        Regional
                    </button>
                    <button
                        @click="activeTab = 'international'"
                        :class="[
                            'rounded-md px-6 py-2 text-sm transition-colors duration-200',
                            activeTab === 'international'
                                ? 'bg-neutral-800 outline outline-1 outline-black'
                                : 'text-gray-400 hover:text-white',
                        ]"
                    >
                        International
                    </button>
                </div>
            </div>

            <div class="relative">
                <button
                    v-if="shouldShowArrows"
                    @click="prevSlide"
                    class="absolute left-0 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-neutral-800 p-2 text-white opacity-75 transition-opacity hover:opacity-100 focus:outline-none md:-left-12"
                    aria-label="Previous slide"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </button>

                <button
                    v-if="shouldShowArrows"
                    @click="nextSlide"
                    class="absolute right-0 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-neutral-800 p-2 text-white opacity-75 transition-opacity hover:opacity-100 focus:outline-none md:-right-12"
                    aria-label="Next slide"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </button>

                <div class="overflow-hidden">
                    <div
                        class="flex transition-transform duration-300 ease-in-out"
                        :style="{
                            transform: `translateX(-${currentSlide * 100}%)`,
                        }"
                    >
                        <div
                            v-if="
                                activeTab === 'all' || activeTab === 'regional'
                            "
                            class="flex w-full flex-shrink-0 flex-col gap-8 md:grid md:grid-cols-2"
                        >
                            <div
                                class="flex flex-col rounded-md border border-neutral-700 bg-neutral-900/20 p-6"
                            >
                                <div
                                    class="mb-2 text-sm font-medium text-gray-400"
                                >
                                    Main Headquarters
                                </div>
                                <h3 class="mb-4 text-xl font-medium">
                                    123 Real estate Plaza, City Center,
                                    Metropolis
                                </h3>
                                <p class="mb-6 text-gray-400">
                                    Our main headquarters serve as the heart of
                                    Real estate. Located in the bustling city
                                    center, this is where our core team of
                                    experts operates, driving the excellence and
                                    innovation that define us.
                                </p>
                                <div class="mt-auto">
                                    <div class="mb-4 flex flex-wrap gap-4">
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >info@realstate.com</span
                                            >
                                        </div>
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >+1 (123) 456-7890</span
                                            >
                                        </div>
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                />
                                                <path
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >Metropolis</span
                                            >
                                        </div>
                                    </div>
                                    <a
                                        href="https://www.google.com"
                                        class="block w-full rounded-sm bg-purple-600 py-3 text-center text-white transition-colors duration-300 hover:bg-purple-700"
                                    >
                                        Get Direction
                                    </a>
                                </div>
                            </div>

                            <div
                                class="flex flex-col rounded-md border border-neutral-700 bg-neutral-900/20 p-6"
                            >
                                <div
                                    class="mb-2 text-sm font-medium text-gray-400"
                                >
                                    Regional Offices
                                </div>
                                <h3 class="mb-4 text-xl font-medium">
                                    456 Urban Avenue, Downtown District,
                                    Metropolis
                                </h3>
                                <p class="mb-6 text-gray-400">
                                    Real estate's presence extends to multiple
                                    regions, each with its own dynamic real
                                    estate landscape. Discover our regional
                                    offices, staffed by local experts who
                                    understand the nuances of their respective
                                    markets.
                                </p>
                                <div class="mt-auto">
                                    <div class="mb-4 flex flex-wrap gap-4">
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >info@realstate.com</span
                                            >
                                        </div>
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >+1 (123) 456-7890</span
                                            >
                                        </div>
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                />
                                                <path
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >Metropolis</span
                                            >
                                        </div>
                                    </div>
                                    <a
                                        href="https://www.google.com"
                                        class="block w-full rounded-sm bg-purple-600 py-3 text-center text-white transition-colors duration-300 hover:bg-purple-700"
                                    >
                                        Get Direction
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div
                            v-if="
                                activeTab === 'all' ||
                                activeTab === 'international'
                            "
                            class="flex w-full flex-shrink-0 flex-col gap-8 md:grid md:grid-cols-2"
                        >
                            <div
                                class="flex flex-col rounded-md border border-neutral-700 bg-neutral-900/20 p-6"
                            >
                                <div
                                    class="mb-2 text-sm font-medium text-gray-400"
                                >
                                    International Headquarters
                                </div>
                                <h3 class="mb-4 text-xl font-medium">
                                    789 Global Tower, Financial District, London
                                </h3>
                                <p class="mb-6 text-gray-400">
                                    Our international headquarters connects Real
                                    estate to the global real estate market.
                                    Located in the heart of London, this office
                                    serves as our gateway to international
                                    clients and opportunities.
                                </p>
                                <div class="mt-auto">
                                    <div class="mb-4 flex flex-wrap gap-4">
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >global@realstate.com</span
                                            >
                                        </div>
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >+44 20 1234 5678</span
                                            >
                                        </div>
                                        <div
                                            class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 text-white"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                />
                                                <path
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                            <span class="text-sm text-white"
                                                >London</span
                                            >
                                        </div>
                                    </div>
                                    <a
                                        href="https://www.google.com"
                                        class="block w-full rounded-sm bg-purple-600 py-3 text-center text-white transition-colors duration-300 hover:bg-purple-700"
                                    >
                                        Get Direction
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    v-if="totalSlides > 1"
                    class="mt-6 flex justify-center gap-2"
                >
                    <button
                        v-for="(_, index) in totalSlides"
                        :key="index"
                        @click="goToSlide(index)"
                        :class="[
                            'h-2 w-2 rounded-full transition-all',
                            currentSlide === index
                                ? 'w-4 bg-purple-600'
                                : 'bg-neutral-700 hover:bg-neutral-500',
                        ]"
                        :aria-label="`Go to slide ${index + 1}`"
                    ></button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { computed, ref, watch } from 'vue';

const activeTab = ref('all');
const currentSlide = ref(0);

const totalLocations = computed(() => {
    if (activeTab.value === 'all') {
        return 3;
    } else if (activeTab.value === 'regional') {
        return 2;
    } else if (activeTab.value === 'international') {
        return 1;
    }
    return 0;
});

const totalSlides = computed(() => {
    if (activeTab.value === 'all') {
        return 2;
    } else if (activeTab.value === 'regional') {
        return 1;
    } else if (activeTab.value === 'international') {
        return 1;
    }
    return 0;
});

const shouldShowArrows = computed(() => {
    return totalLocations.value > 2;
});

const nextSlide = () => {
    if (currentSlide.value < totalSlides.value - 1) {
        currentSlide.value++;
    } else {
        currentSlide.value = 0;
    }
};

const prevSlide = () => {
    if (currentSlide.value > 0) {
        currentSlide.value--;
    } else {
        currentSlide.value = totalSlides.value - 1;
    }
};

const goToSlide = (index: number) => {
    currentSlide.value = index;
};

watch(activeTab, () => {
    currentSlide.value = 0;
});
</script>
