<template>
    <li class="relative bg-gray-900/40 py-3 pl-12">
        <div class="absolute bottom-0 left-0 top-0 w-1 bg-purple-600"></div>
        <div class="flex items-center gap-4">
            <ThunderIcon />
            <span class="text-lg text-gray-400">{{ card.description }}</span>
        </div>
    </li>
</template>

<script setup lang="ts">
import ThunderIcon from '@/Components/PropertyDetails/Gallery/Amenities/ThunderIcon.vue';
import { AmenitiesInterface } from '@/Types/App/Interfaces';

const { card }: { card: AmenitiesInterface } = defineProps<{
    card: AmenitiesInterface;
}>();
</script>
