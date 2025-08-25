<template>
    <div>
        <h1>{{ title }}</h1>
        <div>{{ description }}</div>
    </div>
</template>

<script setup lang="ts">
import { computed, Ref } from 'vue';

const { statusCode }: { statusCode: number } = defineProps<{
    statusCode: number;
}>();

const titles: Record<number, string> = {
    503: '503: Service Unavailable',
    500: '500: Server Error',
    404: '404: Page Not Found',
    403: '403: Forbidden',
};

const descriptions: Record<number, string> = {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
};

const title: Ref<string> = computed(
    (): string => titles[statusCode] ?? titles[500],
);
const description: Ref<string> = computed(
    (): string => descriptions[statusCode] ?? descriptions[500],
);
</script>
