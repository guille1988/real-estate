<template>
    <div class="min-h-screen bg-gray-900 text-white">
        <!-- Header -->
        <header
            class="container mx-auto flex items-center justify-between px-4 py-6"
        >
            <div class="text-2xl font-bold">Logo</div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#" class="hover:text-gray-300">Home</a></li>
                    <li><a href="#" class="hover:text-gray-300">About</a></li>
                    <li>
                        <a href="#" class="hover:text-gray-300">Properties</a>
                    </li>
                    <li><a href="#" class="hover:text-gray-300">Contact</a></li>
                </ul>
            </nav>
            <button class="rounded bg-blue-600 px-4 py-2 hover:bg-blue-700">
                Sign Up
            </button>
        </header>

        <!-- Hero Section -->
        <section class="container mx-auto px-4 py-20 text-center">
            <h1 class="mb-6 text-5xl font-bold">Find Your Dream Home</h1>
            <p class="mb-8 text-xl">
                Discover the perfect property in your ideal location
            </p>
            <div class="mx-auto max-w-3xl rounded-lg bg-gray-800 p-6">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <input
                        type="text"
                        placeholder="Location"
                        class="rounded bg-gray-700 p-2"
                    />
                    <input
                        type="text"
                        placeholder="Property Type"
                        class="rounded bg-gray-700 p-2"
                    />
                    <input
                        type="text"
                        placeholder="Price Range"
                        class="rounded bg-gray-700 p-2"
                    />
                </div>
                <button
                    class="mt-4 w-full rounded bg-blue-600 px-6 py-2 hover:bg-blue-700 md:w-auto"
                >
                    Search
                </button>
            </div>
        </section>

        <!-- Featured Properties -->
        <section class="container mx-auto px-4 py-16">
            <h2 class="mb-8 text-3xl font-bold">Featured Properties</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div
                    v-for="i in 3"
                    :key="i"
                    class="overflow-hidden rounded-lg bg-gray-800"
                >
                    <img
                        src=""
                        alt="Property"
                        class="h-48 w-full object-cover"
                    />
                    <div class="p-4">
                        <h3 class="mb-2 text-xl font-bold">
                            Beautiful House {{ i }}
                        </h3>
                        <p class="mb-4 text-gray-400">
                            123 Main St, City, State
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-blue-500"
                                >$500,000</span
                            >
                            <button
                                class="rounded bg-blue-600 px-4 py-2 hover:bg-blue-700"
                            >
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-blue-600 py-16 text-center">
            <div class="container mx-auto px-4">
                <h2 class="mb-4 text-3xl font-bold">
                    Ready to Find Your Dream Home?
                </h2>
                <p class="mb-8 text-xl">
                    Let us help you discover the perfect property for you and
                    your family.
                </p>
                <button
                    class="rounded-lg bg-white px-8 py-3 text-lg font-bold text-blue-600 hover:bg-gray-100"
                >
                    Get Started
                </button>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 py-8">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2023 Real Estate Company. All rights reserved.</p>
            </div>
        </footer>
    </div>
</template>

<script lang="ts" setup></script>

<style scoped></style>
