<template>
    <div
        class="border border-neutral-800 bg-neutral-900/30 p-6 transition-all duration-300 hover:border-purple-500/50"
    >
        <div class="mb-4 flex items-center">
            <div
                class="mr-4 flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-purple-500/10"
            >
                <component :is="icon" class="h-8 w-8 text-purple-500" />
            </div>
            <h3 class="text-xl font-medium">{{ card.title }}</h3>
        </div>
        <p class="text-gray-400">
            {{ card.description }}
        </p>
    </div>
</template>

<script setup lang="ts">
import { UnlockPropertyCardInterface } from '@/Types/App/Interfaces';
import { defineAsyncComponent, type Component } from 'vue';

const { card }: { card: UnlockPropertyCardInterface } = defineProps<{
    card: UnlockPropertyCardInterface;
}>();

const icon: Component = defineAsyncComponent(
    (): Promise<Component> =>
        import(`./Icons/${card.icon}.vue`) as Promise<Component>,
);
</script>
