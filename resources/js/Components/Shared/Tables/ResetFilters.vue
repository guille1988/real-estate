<template>
    <button
        type="button"
        title="Reset filters"
        aria-label="Resel filters"
        @click="resetFilters"
        class="shadow-xs block rounded-md bg-red-600 p-2 text-white hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
    >
        <ArrowPathIcon class="size-5" aria-hidden="true" />
    </button>
</template>

<script setup lang="ts">
import { ArrowPathIcon } from '@heroicons/vue/24/outline';
import { router } from '@inertiajs/vue3';

const resetFilters = (): void => {
    const answer: boolean = confirm(
        'Are you sure you want to reset all filters?',
    );

    if (!answer) {
        return;
    }

    router.visit(window.location.pathname, { replace: true });
};
</script>
