<template>
    <form class="mb-3 mt-3 grid flex-1 grid-cols-1" action="#" method="GET">
        <input
            name="search"
            aria-label="Search"
            class="col-start-1 row-start-1 block size-full rounded-md border border-white/10 bg-gray-900 pl-10 pr-3 text-base text-white caret-purple-400 selection:bg-purple-600 selection:text-white placeholder:text-gray-500 focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-0 sm:text-sm/6"
            placeholder="Search"
        />
        <MagnifyingGlassIcon
            class="pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400"
            aria-hidden="true"
        />
    </form>
</template>

<script setup lang="ts">
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid';
</script>
