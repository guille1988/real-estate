<template>
    <div
        class="rounded-xl border border-gray-800 bg-gray-900/50 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-purple-900/30 hover:shadow-lg hover:shadow-purple-900/20"
    >
        <div class="mb-4 flex gap-1">
            <FiveStarsIcon />
        </div>

        <h3 class="mb-4 text-xl font-semibold">{{ card.title }}</h3>
        <p class="mb-6 text-gray-400">
            {{ card.description }}
        </p>

        <div class="flex items-center gap-3">
            <img
                :src="card.thumbnail"
                :alt="card.name"
                class="h-10 w-10 rounded-full object-cover"
            />
            <div>
                <h4 class="font-semibold">{{ card.name }}</h4>
                <p class="text-sm text-gray-400">{{ card.location }}</p>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import FiveStarsIcon from '@/Components/Icons/FiveStarsIcon.vue';
import { ClientTestimonialCardInterface } from '@/Types/App/Interfaces';

const { card }: { card: ClientTestimonialCardInterface } = defineProps<{
    card: ClientTestimonialCardInterface;
}>();
</script>
