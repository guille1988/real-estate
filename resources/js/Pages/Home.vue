<template>
    <Layout>
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
                        src="https://images.squarespace-cdn.com/content/v1/58487dc4b8a79b6d02499b60/1649818728006-EX0EE6EYY82VW5KZMX7Q/Francis+York+One+of+the+Most+Beautiful+Homes+For+Sale+in+Illinois+17.jpg?format=2500w"
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
    </Layout>
</template>

<script lang="ts" setup>
import Layout from '@/Layouts/Layout.vue';
</script>
