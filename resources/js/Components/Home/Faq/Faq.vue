<template>
    <div class="w-full bg-black">
        <div class="mx-auto max-w-[1920px] px-[112px] py-12">
            <div
                class="mb-16 flex flex-col items-start justify-between md:flex-row md:items-center"
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
                <button
                    class="mt-6 rounded-md border border-gray-800 bg-black px-6 py-2 text-white transition-colors hover:bg-gray-900 md:mt-0"
                >
                    View All FAQ's
                </button>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div
                    class="flex h-full flex-col rounded-lg border border-gray-800 bg-[#0A0A0A] p-8"
                >
                    <h2 class="mb-6 text-2xl font-bold text-white">
                        How do I search for properties on Real estate?
                    </h2>
                    <p class="mb-8 flex-grow text-gray-400">
                        Learn how to use our user-friendly search tools to find
                        properties that match your criteria.
                    </p>
                    <button
                        class="self-start rounded-md border border-gray-800 bg-black px-6 py-3 text-white transition-colors hover:bg-gray-900"
                    >
                        Read More
                    </button>
                </div>

                <div
                    class="flex h-full flex-col rounded-lg border border-gray-800 bg-[#0A0A0A] p-8"
                >
                    <h2 class="mb-6 text-2xl font-bold text-white">
                        What documents do I need to sell my property through
                        Real estate?
                    </h2>
                    <p class="mb-8 flex-grow text-gray-400">
                        Find out about the necessary documentation for listing
                        your property with us.
                    </p>
                    <button
                        class="self-start rounded-md border border-gray-800 bg-black px-6 py-3 text-white transition-colors hover:bg-gray-900"
                    >
                        Read More
                    </button>
                </div>

                <div
                    class="flex h-full flex-col rounded-lg border border-gray-800 bg-[#0A0A0A] p-8"
                >
                    <h2 class="mb-6 text-2xl font-bold text-white">
                        How can I contact an Real estate agent?
                    </h2>
                    <p class="mb-8 flex-grow text-gray-400">
                        Discover the different ways you can get in touch with
                        our experienced agents.
                    </p>
                    <button
                        class="self-start rounded-md border border-gray-800 bg-black px-6 py-3 text-white transition-colors hover:bg-gray-900"
                    >
                        Read More
                    </button>
                </div>
            </div>

            <div class="mt-16 flex items-center justify-between">
                <div class="text-lg text-white">
                    <span class="font-medium">01</span> of <span>10</span>
                </div>
                <div class="flex gap-4">
                    <button
                        class="rounded-md border border-gray-800 bg-black p-2 transition-colors hover:bg-gray-900"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-white"
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
                        class="rounded-md border border-gray-800 bg-black p-2 transition-colors hover:bg-gray-900"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-white"
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
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
</script>
