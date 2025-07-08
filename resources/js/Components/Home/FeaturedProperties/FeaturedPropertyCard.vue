<template>
    <div
        class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900/50 transition-all duration-300 hover:-translate-y-1 hover:border-purple-900/30 hover:shadow-lg hover:shadow-purple-900/20"
    >
        <div class="relative overflow-hidden">
            <img
                :src="card.image"
                :alt="card.title"
                class="h-48 w-full object-cover transition-transform duration-700 ease-in-out hover:scale-110 sm:h-56 md:h-64"
            />

            <div
                class="absolute bottom-0 left-0 right-0 bg-black/70 p-2 text-xs"
            >
                <p class="text-purple-400">
                    {{ card.caption }}
                </p>
            </div>
        </div>
        <div class="p-4 md:p-6">
            <h3
                class="mb-2 text-lg font-semibold transition-colors duration-300 group-hover:text-purple-400 md:text-xl"
            >
                {{ card.title }}
            </h3>
            <p class="mb-4 text-xs text-gray-400 md:text-sm">
                {{ card.description }}
            </p>

            <div class="mb-4 flex flex-wrap gap-2 md:mb-6 md:gap-4">
                <div class="flex items-center gap-1 md:gap-2">
                    <BedroomIcon
                        class="h-4 w-4 text-gray-800 dark:text-white"
                    />
                    <span class="text-xs text-gray-400 md:text-sm"
                        >{{ card.bedrooms }}-Bedroom</span
                    >
                </div>
                <div class="flex items-center gap-1 md:gap-2">
                    <BathroomIcon class="h-4 w-4 text-white" />
                    <span class="text-xs text-gray-400 md:text-sm"
                        >{{ card.bathrooms }}-Bathroom</span
                    >
                </div>
                <div class="flex items-center gap-1 md:gap-2">
                    <BuildingIcon
                        class="h-4 w-4 text-gray-800 dark:text-white"
                    />
                    <span class="text-xs text-gray-400 md:text-sm">{{
                        capitalizeFirstLetter(card.type)
                    }}</span>
                </div>
            </div>

            <div
                class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <p class="text-xs text-gray-400">Price</p>
                    <p class="text-lg font-semibold md:text-xl">
                        {{ card.price }}
                    </p>
                </div>
                <button
                    @click="router.visit(show(card.uuid).url)"
                    class="w-full rounded-md bg-purple-600 px-4 py-2 text-xs transition-colors duration-300 hover:bg-purple-500 sm:w-auto md:px-6 md:py-3 md:text-sm"
                >
                    View Property Details
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BathroomIcon from '@/Components/Icons/BathroomIcon.vue';
import BedroomIcon from '@/Components/Icons/BedroomIcon.vue';
import BuildingIcon from '@/Components/Icons/BuildingIcon.vue';
import { capitalizeFirstLetter } from '@/Composables/useCapitalization';
import { show } from '@/Routes/actions/App/Http/Controllers/PropertyController';
import { FeaturedPropertyCardInterface } from '@/Types/App/Interfaces/FeaturedPropertyCardInterface';
import { router } from '@inertiajs/vue3';

const { card }: { card: FeaturedPropertyCardInterface } = defineProps<{
    card: FeaturedPropertyCardInterface;
}>();
</script>
