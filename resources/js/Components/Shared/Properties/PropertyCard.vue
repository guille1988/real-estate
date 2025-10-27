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
            <div class="mb-4">
                <p
                    class="text-xs text-gray-400 md:text-sm"
                    :class="{ 'line-clamp-2': !showFullDescription }"
                >
                    {{ card.description }}
                </p>
                <button
                    v-if="card.description.length > 100"
                    @click="toggleShowFullDescription()"
                    class="mt-1 text-xs text-purple-500 hover:text-purple-400 focus:outline-none"
                >
                    {{ showFullDescription ? 'Read Less' : 'Read More...' }}
                </button>
            </div>

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
                        title(card.type)
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
                <Link prefetch :href="show(card.uuid).url">
                    <button
                        class="w-full rounded-md bg-purple-600 px-4 py-2 text-xs transition-colors duration-300 hover:bg-purple-500 disabled:cursor-not-allowed disabled:bg-purple-400 disabled:text-gray-300 disabled:hover:bg-purple-400 sm:w-auto md:px-6 md:py-3 md:text-sm"
                        :disabled="!card.canShowProperty"
                        :aria-disabled="!card.canShowProperty"
                        :title="getTitle()"
                    >
                        View Property Details
                    </button>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import BathroomIcon from '@/Components/Icons/BathroomIcon.vue';
import BedroomIcon from '@/Components/Icons/BedroomIcon.vue';
import BuildingIcon from '@/Components/Icons/BuildingIcon.vue';
import { title } from '@/Composables/useTitleCase';
import { show } from '@/Routes/actions/App/Http/Controllers/PropertyController';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';
import { Link } from '@inertiajs/vue3';
import { Ref, ref } from 'vue';

const { card }: { card: IndexPropertyInterface } = defineProps<{
    card: IndexPropertyInterface;
}>();

const showFullDescription: Ref<boolean> = ref<boolean>(false);

const toggleShowFullDescription = (): void => {
    showFullDescription.value = !showFullDescription.value;
};

const getTitle = (): string =>
    card.canShowProperty
        ? card.title
        : 'This property has been disabled by the administrator.';
</script>
