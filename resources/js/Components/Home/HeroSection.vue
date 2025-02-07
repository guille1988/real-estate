<template>
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
</template>

<script lang="ts" setup></script>
