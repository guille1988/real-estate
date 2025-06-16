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
import { SliderArrowDirectionEnum } from '@/Types/App/Enums/SliderArrowDirectionEnum';

const { direction }: { direction: SliderArrowDirectionEnum } = defineProps<{
    direction: SliderArrowDirectionEnum;
}>();

const getDirection = (): string => {
    const directions: Record<SliderArrowDirectionEnum, string> = {
        [SliderArrowDirectionEnum.RIGHT]: 'M9 18l6-6-6-6',
        [SliderArrowDirectionEnum.LEFT]: 'M15 18l-6-6 6-6',
    };

    return directions[direction];
};
</script>
