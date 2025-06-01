<template>
    <section class="bg-black px-4 py-20">
        <div class="container mx-auto">
            <div class="mb-12 text-center">
                <h1 class="mb-4 text-4xl font-bold text-white md:text-5xl">
                    Find Your Dream Property
                </h1>
                <p class="mx-auto max-w-3xl text-gray-400">
                    Welcome to Real estate, where your dream property awaits in
                    every corner of our beautiful world. Explore our curated
                    selection of properties, each offering a unique story and a
                    chance to redefine your life. With categories to suit every
                    dreamer, your journey.
                </p>
            </div>

            <div class="mx-auto mb-6 max-w-3xl">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Search For A Property"
                        class="w-full rounded-lg bg-[#111] px-4 py-3 pr-32 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600"
                    />
                    <button
                        class="absolute right-2 top-1/2 -translate-y-1/2 rounded-lg bg-purple-600 px-6 py-2 text-sm font-medium text-white hover:bg-purple-700"
                    >
                        Find Property
                    </button>
                </div>
            </div>

            <div
                class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5"
            >
                <button
                    class="flex items-center justify-between rounded-lg bg-[#111] px-4 py-3 text-left text-gray-400 hover:bg-[#1a1a1a]"
                >
                    <div class="flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-gray-500"
                        >
                            <path
                                d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"
                            />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        Location
                    </div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-gray-500"
                    >
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <button
                    class="flex items-center justify-between rounded-lg bg-[#111] px-4 py-3 text-left text-gray-400 hover:bg-[#1a1a1a]"
                >
                    <div class="flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-gray-500"
                        >
                            <path
                                d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                            />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Property Type
                    </div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-gray-500"
                    >
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <button
                    class="flex items-center justify-between rounded-lg bg-[#111] px-4 py-3 text-left text-gray-400 hover:bg-[#1a1a1a]"
                >
                    <div class="flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-gray-500"
                        >
                            <circle cx="12" cy="12" r="10" />
                            <path
                                d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"
                            />
                            <path d="M12 18V6" />
                        </svg>
                        Pricing Range
                    </div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-gray-500"
                    >
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <button
                    class="flex items-center justify-between rounded-lg bg-[#111] px-4 py-3 text-left text-gray-400 hover:bg-[#1a1a1a]"
                >
                    <div class="flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-gray-500"
                        >
                            <path d="M3 3v18h18" />
                            <path d="M7 17v-4h4" />
                            <path d="M17 17v-8h4" />
                            <path d="M13 17v-6h4" />
                        </svg>
                        Property Size
                    </div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-gray-500"
                    >
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <button
                    class="flex items-center justify-between rounded-lg bg-[#111] px-4 py-3 text-left text-gray-400 hover:bg-[#1a1a1a]"
                >
                    <div class="flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="text-gray-500"
                        >
                            <rect
                                width="18"
                                height="18"
                                x="3"
                                y="4"
                                rx="2"
                                ry="2"
                            />
                            <line x1="16" x2="16" y1="2" y2="6" />
                            <line x1="8" x2="8" y1="2" y2="6" />
                            <line x1="3" x2="21" y1="10" y2="10" />
                        </svg>
                        Build Year
                    </div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-gray-500"
                    >
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
</template>
