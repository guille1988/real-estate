<template>
    <div class="mt-4 sm:mt-0 sm:flex-none">
        <Link
            prefetch
            :href="url"
            class="shadow-xs block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500"
        >
            Back to Index
        </Link>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    url: string;
}>();
</script>
