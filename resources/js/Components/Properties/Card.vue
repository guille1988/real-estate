<template>
    <div
        class="group overflow-hidden rounded-xl bg-[#111] transition-all hover:bg-[#1a1a1a]"
    >
        <div class="relative aspect-[4/3] overflow-hidden">
            <img
                :src="property.image"
                :alt="property.title"
                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
            />
        </div>

        <div class="p-6">
            <p class="mb-2 text-sm text-gray-400">{{ property.category }}</p>

            <h3 class="mb-3 text-xl font-semibold text-white">
                {{ property.title }}
            </h3>

            <p class="text-gray-400">
                {{ property.description }}
                <button class="ml-1 text-purple-500 hover:text-purple-400">
                    Read More
                </button>
            </p>

            <div class="mt-6 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400">Price</p>
                    <p class="text-lg font-semibold text-white">
                        ${{ property.price.toLocaleString() }}
                    </p>
                </div>
                <button
                    @click="openDetails(property.id)"
                    class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-medium text-white hover:bg-purple-700"
                >
                    View Property Details
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';

interface Property {
    id: number;
    image: string;
    category: string;
    title: string;
    description: string;
    price: number;
}

defineProps<{
    property: Property;
}>();

const openDetails = (id: number): void => {
    router.visit(route('properties.show', { property: id }));
};
</script>
