<template>
    <div class="rounded-lg bg-gray-900/50 p-8">
        <div class="mb-6 flex items-start justify-between">
            <div>
                <p class="mb-2 text-gray-400">{{ card.since }}</p>
                <h3 class="mb-4 text-2xl font-bold">{{ card.company }}</h3>
            </div>
            <button
                class="rounded-lg bg-gray-800 px-4 py-2 text-white transition-colors hover:bg-gray-700"
                @click="visitWebsite"
            >
                Visit Website
            </button>
        </div>

        <div class="mb-8 grid grid-cols-2 gap-8">
            <div>
                <div class="mb-2 flex items-center gap-2 text-gray-400">
                    <GridIcon />
                    {{ card.domain }}
                </div>
                <p class="text-white">Commercial Real Estate</p>
            </div>
            <div>
                <div class="mb-2 flex items-center gap-2 text-gray-400">
                    <ThunderIcon />
                    {{ card.category }}
                </div>
                <p class="text-white">{{ card.company }}</p>
            </div>
        </div>

        <div class="rounded-lg bg-black/50 p-6">
            <div class="mb-3 flex items-center gap-2 text-gray-400">
                <span>What They Said</span>
                <FaceIcon />
            </div>
            <p class="text-gray-300">
                {{ card.what_they_said }}
            </p>
        </div>
    </div>
</template>
<script setup lang="ts">
import FaceIcon from '@/Components/Icons/FaceIcon.vue';
import ThunderIcon from '@/Components/PropertyDetails/Gallery/Amenities/ThunderIcon.vue';
import GridIcon from '@/Components/Services/EffortlessPropertyManagement/EffortlessPropertyCard/Icons/GridIcon.vue';
import { ClientCardInterface } from '@/Types/App/Interfaces';

const { card }: { card: ClientCardInterface } = defineProps<{
    card: ClientCardInterface;
}>();

const visitWebsite = (): void => {
    window.open(card.url, '_blank');
};
</script>
