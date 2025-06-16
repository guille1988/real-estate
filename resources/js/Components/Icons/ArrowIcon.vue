<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            :d="getDirection()"
        />
    </svg>
</template>

<script setup lang="ts">
import { ArrowDirectionEnum } from '@/Types/App/Enums/ArrowDirectionEnum';

const { direction }: { direction: ArrowDirectionEnum } = defineProps<{
    direction: ArrowDirectionEnum;
}>();

const getDirection = (): string => {
    const directions: Record<ArrowDirectionEnum, string> = {
        [ArrowDirectionEnum.RIGHT]: 'M14 5l7 7m0 0l-7 7m7-7H3',
        [ArrowDirectionEnum.UP_RIGHT]: 'M7 17L17 7M17 7H7M17 7V17',
    };

    return directions[direction];
};
</script>
