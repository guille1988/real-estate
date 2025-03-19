<template>
    <section class="bg-black py-10 text-white md:py-16">
        <div class="container mx-auto px-4">
            <div
                class="mb-8 flex flex-col gap-6 md:mb-12 md:flex-row md:items-start md:justify-between"
            >
                <div class="max-w-2xl">
                    <div class="mb-4 flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                            />
                        </svg>
                        <h2 class="text-2xl font-bold md:text-3xl">
                            What Our Clients Say
                        </h2>
                    </div>
                    <p class="text-sm text-gray-400 md:text-base">
                        Read the success stories and heartfelt testimonials from
                        our valued clients. Discover why they chose Real estate
                        for their real estate needs.
                    </p>
                </div>
                <button
                    class="self-start whitespace-nowrap rounded-md border border-gray-800 bg-transparent px-4 py-2 text-sm transition hover:bg-gray-800 md:px-6 md:py-3 md:text-base"
                >
                    View All Testimonials
                </button>
            </div>

            <div
                class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 lg:grid-cols-3"
            >
                <div
                    class="rounded-xl border border-gray-800 bg-gray-900/50 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-purple-900/30 hover:shadow-lg hover:shadow-purple-900/20"
                >
                    <div class="mb-4 flex gap-1">
                        <svg
                            v-for="star in 5"
                            :key="star"
                            class="h-5 w-5 fill-current text-yellow-400"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                            />
                        </svg>
                    </div>

                    <h3 class="mb-4 text-xl font-semibold">
                        Exceptional Service!
                    </h3>
                    <p class="mb-6 text-gray-400">
                        Our experience with Real estate was outstanding. Their
                        team's dedication and professionalism made finding our
                        dream home a breeze. Highly recommended!
                    </p>

                    <div class="flex items-center gap-3">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLA994hpL3PMmq0scCuWOu0LGsjef49dyXVg&s"
                            alt="Wade Warren"
                            class="h-10 w-10 rounded-full object-cover"
                        />
                        <div>
                            <h4 class="font-semibold">Wade Warren</h4>
                            <p class="text-sm text-gray-400">USA, California</p>
                        </div>
                    </div>
                </div>

                <div
                    class="rounded-xl border border-gray-800 bg-gray-900/50 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-purple-900/30 hover:shadow-lg hover:shadow-purple-900/20"
                >
                    <div class="mb-4 flex gap-1">
                        <svg
                            v-for="star in 5"
                            :key="star"
                            class="h-5 w-5 fill-current text-yellow-400"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                            />
                        </svg>
                    </div>

                    <h3 class="mb-4 text-xl font-semibold">
                        Efficient and Reliable
                    </h3>
                    <p class="mb-6 text-gray-400">
                        Real estate provided us with top-notch service. They
                        helped us sell our property quickly and at a great
                        price. We couldn't be happier with the results.
                    </p>

                    <div class="flex items-center gap-3">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLA994hpL3PMmq0scCuWOu0LGsjef49dyXVg&s"
                            alt="Emelie Thomson"
                            class="h-10 w-10 rounded-full object-cover"
                        />
                        <div>
                            <h4 class="font-semibold">Emelie Thomson</h4>
                            <p class="text-sm text-gray-400">USA, Florida</p>
                        </div>
                    </div>
                </div>

                <div
                    class="rounded-xl border border-gray-800 bg-gray-900/50 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-purple-900/30 hover:shadow-lg hover:shadow-purple-900/20"
                >
                    <div class="mb-4 flex gap-1">
                        <svg
                            v-for="star in 5"
                            :key="star"
                            class="h-5 w-5 fill-current text-yellow-400"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                            />
                        </svg>
                    </div>

                    <h3 class="mb-4 text-xl font-semibold">Trusted Advisors</h3>
                    <p class="mb-6 text-gray-400">
                        The Real estate team guided us through the entire buying
                        process. Their knowledge and commitment to our needs
                        were impressive. Thank you for your support!
                    </p>

                    <div class="flex items-center gap-3">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLA994hpL3PMmq0scCuWOu0LGsjef49dyXVg&s"
                            alt="John Mans"
                            class="h-10 w-10 rounded-full object-cover"
                        />
                        <div>
                            <h4 class="font-semibold">John Mans</h4>
                            <p class="text-sm text-gray-400">USA, Nevada</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-400 md:text-sm">01 of 10</p>
                <div class="flex gap-2">
                    <button
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 md:h-6 md:w-6"
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
                        class="rounded-full border border-gray-800 p-1.5 transition-colors duration-300 hover:bg-gray-800 md:p-2"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 md:h-6 md:w-6"
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
    </section>
</template>
