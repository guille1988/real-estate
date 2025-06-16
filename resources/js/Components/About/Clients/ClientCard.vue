<template>
    <div class="rounded-lg bg-gray-900/50 p-8">
        <div class="mb-6 flex items-start justify-between">
            <div>
                <p class="mb-2 text-gray-400">{{ card.since }}</p>
                <h3 class="mb-4 font-bold">{{ card.company }}</h3>
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
                    <GridIcon class="h-5 w-5" />
                    {{ card.domain }}
                </div>
                <p class="text-white">Commercial Real Estate</p>
            </div>
            <div>
                <div class="mb-2 flex items-center gap-2 text-gray-400">
                    <ThunderIcon class="h-5 w-5" fill="none" />
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
import GridIcon from '@/Components/Icons/GridIcon.vue';
import ThunderIcon from '@/Components/Icons/ThunderIcon.vue';
import { ClientCardInterface } from '@/Types/App/Interfaces/ClientCardInterface';

const { card }: { card: ClientCardInterface } = defineProps<{
    card: ClientCardInterface;
}>();

const visitWebsite = (): void => {
    window.open(card.url, '_blank');
};
</script>
