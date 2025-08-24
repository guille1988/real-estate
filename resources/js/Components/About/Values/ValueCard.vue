<template>
    <div
        class="rounded-lg border border-neutral-800 bg-gray-900/50 p-6 transition-all duration-300 hover:border-purple-500/50"
    >
        <div class="flex items-start gap-4">
            <div
                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600/20"
            >
                <component :is="icon" class="h-6 w-6 text-purple-600" />
            </div>
            <div class="flex flex-col">
                <h3 class="font-semibold">{{ card.title }}</h3>
                <p class="mt-2 text-gray-400">{{ card.description }}</p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useIcon } from '@/Composables/useIcon';
import { ValueCardInterface } from '@/Types/App/Interfaces/ValueCardInterface';
import { type Component } from 'vue';

const { card }: { card: ValueCardInterface } = defineProps<{
    card: ValueCardInterface;
}>();

const icon: Component = useIcon(card.icon);
</script>
