<template>
    <div class="rounded-lg bg-gray-900/50 p-6">
        <div class="flex items-start gap-4">
            <div
                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-600/20"
            >
                <component :is="icon" />
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl font-semibold">{{ card.title }}</h3>
                <p class="mt-2 text-gray-400">{{ card.description }}</p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ValueCardInterface } from '@/Types/App/Interfaces';
import { defineAsyncComponent, type Component } from 'vue';

const { card }: { card: ValueCardInterface } = defineProps<{
    card: ValueCardInterface;
}>();

const icon: Component = defineAsyncComponent(
    (): Promise<Component> =>
        import(`./../../Icons/${card.icon}.vue`) as Promise<Component>,
);
</script>
