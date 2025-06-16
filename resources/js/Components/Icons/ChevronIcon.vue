<template>
    <svg
        class="h-6 w-6"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            :d="getDirection()"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
    </svg>
</template>

<script setup lang="ts">
import { ChevronDirectionEnum } from '@/Types/App/Enums/ChevronDirectionEnum';

const { direction }: { direction: ChevronDirectionEnum } = defineProps<{
    direction: ChevronDirectionEnum;
}>();

const getDirection = (): string => {
    const directions: Record<ChevronDirectionEnum, string> = {
        [ChevronDirectionEnum.RIGHT]: 'M9 18l6-6-6-6',
        [ChevronDirectionEnum.LEFT]: 'M15 18l-6-6 6-6',
    };

    return directions[direction];
};
</script>
