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

        <slot></slot>

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
