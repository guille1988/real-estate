<template>
    <section
        class="w-full bg-black py-16 text-white"
        id="effortless-property-management"
    >
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-16 max-w-3xl">
                <ThreeStars />
                <h2 class="mb-4 text-3xl font-medium">
                    Effortless Property Management
                </h2>
                <p class="leading-relaxed text-gray-400">
                    Owning a property should be a pleasure, not a hassle. Real
                    State's Property Management Service takes the stress out of
                    property ownership, offering comprehensive solutions
                    tailored to your needs. Explore the categories below to see
                    how we can make property management effortless for you.
                </p>
            </div>

            <div
                class="mb-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3"
            >
                <div
                    class="border border-neutral-800 bg-neutral-900/30 p-6 transition-all duration-300 hover:border-purple-500/50"
                >
                    <div class="mb-4 flex items-center">
                        <div
                            class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-purple-500/10"
                        >
                            <svg
                                class="h-6 w-6 text-purple-500"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <rect x="3" y="3" width="7" height="7" />
                                <rect x="14" y="3" width="7" height="7" />
                                <rect x="3" y="14" width="7" height="7" />
                                <rect x="14" y="14" width="7" height="7" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium">Tenant Harmony</h3>
                    </div>
                    <p class="text-gray-400">
                        Our Tenant Management services ensure that your tenants
                        have a smooth and reducing vacancies.
                    </p>
                </div>

                <div
                    class="border border-neutral-800 bg-neutral-900/30 p-6 transition-all duration-300 hover:border-purple-500/50"
                >
                    <div class="mb-4 flex items-center">
                        <div
                            class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-purple-500/10"
                        >
                            <svg
                                class="h-6 w-6 text-purple-500"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path
                                    d="M21 3v18H3V3h18m0-2H3c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zm-9 15h-2v-6h2v6zm4 0h-2V7h2v9zm4 0h-2v-4h2v4zM7 16H5V9h2v7z"
                                />
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium">Maintenance Ease</h3>
                    </div>
                    <p class="text-gray-400">
                        Say goodbye to property maintenance headaches. We handle
                        all aspects of property upkeep.
                    </p>
                </div>

                <div
                    class="border border-neutral-800 bg-neutral-900/30 p-6 transition-all duration-300 hover:border-purple-500/50"
                >
                    <div class="mb-4 flex items-center">
                        <div
                            class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-purple-500/10"
                        >
                            <svg
                                class="h-6 w-6 text-purple-500"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                                />
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium">
                            Financial Peace of Mind
                        </h3>
                    </div>
                    <p class="text-gray-400">
                        Managing property finances can be complex. Our financial
                        experts take care of rent collection.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div
                    class="border border-neutral-800 bg-neutral-900/30 p-6 transition-all duration-300 hover:border-purple-500/50"
                >
                    <div class="mb-4 flex items-center">
                        <div
                            class="mr-4 flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-purple-500/10"
                        >
                            <svg
                                class="h-6 w-6 text-purple-500"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path
                                    d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"
                                />
                            </svg>
                        </div>
                        <h3 class="text-xl font-medium">Legal Guardian</h3>
                    </div>
                    <p class="text-gray-400">
                        Stay compliant with property laws and regulations
                        effortlessly.
                    </p>
                </div>

                <div
                    class="border border-neutral-800 bg-neutral-900 p-6 md:col-span-2"
                >
                    <div
                        class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between"
                    >
                        <h2
                            class="mb-4 text-2xl font-medium sm:mb-0 lg:text-3xl"
                        >
                            Experience Effortless Property Management
                        </h2>
                        <button
                            class="self-start bg-black px-6 py-3 text-white transition-colors duration-300 sm:self-center"
                        >
                            Learn More
                        </button>
                    </div>

                    <p class="text-gray-400">
                        Ready to experience hassle-free property management?
                        Explore our Property Management Service categories and
                        let us handle the complexities while you enjoy the
                        benefits of property ownership.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
</script>
