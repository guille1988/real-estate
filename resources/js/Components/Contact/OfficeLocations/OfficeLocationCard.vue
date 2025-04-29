<template>
    <div
        class="flex flex-col rounded-md border border-neutral-700 bg-neutral-900/20 p-6"
    >
        <div class="mb-2 text-sm font-medium text-gray-400">
            {{ card.title }}
        </div>
        <h3 class="mb-4 text-xl font-medium">
            {{ card.address }}
        </h3>
        <p class="mb-6 text-gray-400">
            {{ card.description }}
        </p>
        <div class="mt-auto">
            <div class="mb-4 flex flex-wrap gap-4">
                <div
                    class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                >
                    <EmailIcon />
                    <span class="text-sm text-white">{{ card.email }}</span>
                </div>
                <div
                    class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                >
                    <PhoneIcon />
                    <span class="text-sm text-white">{{ card.phone }}</span>
                </div>
                <div
                    class="flex items-center rounded-full bg-neutral-800 px-4 py-2"
                >
                    <LocationIcon />
                    <span class="text-sm text-white">{{ card.location }}</span>
                </div>
            </div>
            <a
                :href="card.url"
                class="block w-full rounded-sm bg-purple-600 py-3 text-center text-white transition-colors duration-300 hover:bg-purple-700"
            >
                Get Direction
            </a>
        </div>
    </div>
</template>

<script setup lang="ts">
import EmailIcon from '@/Components/Contact/OfficeLocations/Icons/EmailIcon.vue';
import LocationIcon from '@/Components/Contact/OfficeLocations/Icons/LocationIcon.vue';
import PhoneIcon from '@/Components/Contact/OfficeLocations/Icons/PhoneIcon.vue';
import { OfficeLocationCardInterface } from '@/Types/App/Interfaces';

const { card }: { card: OfficeLocationCardInterface } = defineProps<{
    card: OfficeLocationCardInterface;
}>();
</script>
