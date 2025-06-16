<template>
    <a
        :href="card.link"
        class="group relative block cursor-pointer border border-neutral-800 bg-neutral-900/30 p-6 transition-all duration-300 hover:border-purple-500/50"
    >
        <div class="absolute right-4 top-4">
            <ArrowIcon
                :direction="ArrowDirectionEnum.UP_RIGHT"
                class="h-4 w-4 text-gray-400 group-hover:text-purple-500"
            />
        </div>
        <div class="flex flex-col items-center text-center">
            <div
                class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-purple-500/10"
            >
                <component :is="icon" class="h-6 w-6 text-purple-500" />
            </div>
            <span class="text-gray-400 group-hover:text-white">{{
                card.label
            }}</span>
        </div>
    </a>
</template>
<script setup lang="ts">
import ArrowIcon from '@/Components/Icons/ArrowIcon.vue';
import { useIcon } from '@/Composables/useIcon';
import { ArrowDirectionEnum } from '@/Types/App/Enums/ArrowDirectionEnum';
import { GetInTouchCardInterface } from '@/Types/App/Interfaces/GetInTouchCardInterface';
import { type Component } from 'vue';

const { card }: { card: GetInTouchCardInterface } = defineProps<{
    card: GetInTouchCardInterface;
}>();

const icon: Component = useIcon(card.icon);
</script>
