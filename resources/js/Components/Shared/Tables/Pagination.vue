<template>
    <div
        class="flex items-center justify-between border-t border-white/10 px-4 py-3 sm:px-6"
    >
        <div class="flex flex-1 justify-between sm:hidden">
            <Link
                v-if="Boolean(prevPageUrl)"
                :href="prevPageUrl ?? '#'"
                class="relative inline-flex items-center rounded-md border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-gray-200 hover:bg-white/10"
                >Previous</Link
            >
            <Link
                v-if="Boolean(nextPageUrl)"
                :href="nextPageUrl ?? '#'"
                class="relative ml-3 inline-flex items-center rounded-md border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-gray-200 hover:bg-white/10"
                >Next</Link
            >
        </div>
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-300">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium">{{ from }}</span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium">{{ to }}</span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium">{{ total }}</span>
                    {{ ' ' }}
                    results
                </p>
            </div>
            <div>
                <nav
                    class="isolate inline-flex -space-x-px rounded-md ring-1 ring-white/20"
                    aria-label="Pagination"
                >
                    <Link
                        v-if="Boolean(prevPageUrl)"
                        :href="prevPageUrl ?? '#'"
                        class="relative inline-flex items-center rounded-l-md border border-white/20 px-2 py-2 text-gray-400 hover:bg-white/5 hover:text-purple-500 focus:z-20 focus:outline-offset-0"
                    >
                        <span class="sr-only">Previous</span>
                        <ChevronLeftIcon class="size-5" aria-hidden="true" />
                    </Link>
                    <div v-for="link in allLinks" :key="link.label">
                        <span
                            v-if="isSeparator(link.page)"
                            :class="separatorClass"
                            aria-hidden="true"
                        >
                            {{ link.label }}
                        </span>
                        <Link
                            v-else
                            :href="link.url ?? '#'"
                            :class="getClass(link.active)"
                        >
                            {{ link.label }}
                        </Link>
                    </div>

                    <Link
                        v-if="Boolean(nextPageUrl)"
                        :href="nextPageUrl ?? '#'"
                        class="relative inline-flex items-center rounded-r-md border border-white/20 px-2 py-2 text-gray-400 hover:bg-white/5 hover:text-purple-500 focus:z-20 focus:outline-offset-0"
                    >
                        <span class="sr-only">Next</span>
                        <ChevronRightIcon class="size-5" aria-hidden="true" />
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import type { PaginationLinksInterfaceInterface } from '@/Types/Admin/Interfaces/PaginationLinksInterfaceInterface.js';
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid';
import { Link } from '@inertiajs/vue3';
import { computed, ComputedRef } from 'vue';

const {
    total,
    from,
    to,
    links,
    prevPageUrl,
    nextPageUrl,
}: {
    total: number;
    from: number;
    to: number;
    links: PaginationLinksInterfaceInterface[];
    prevPageUrl: string | null;
    nextPageUrl: string | null;
} = defineProps<{
    total: number;
    from: number;
    to: number;
    links: PaginationLinksInterfaceInterface[];
    prevPageUrl: string | null;
    nextPageUrl: string | null;
}>();

const numberClass: string =
    'relative inline-flex items-center border border-white/20 px-4 py-2 text-sm font-semibold text-gray-200 hover:bg-white/5 hover:text-purple-500 focus:z-20 focus:outline-offset-0';

const separatorClass: string =
    'relative inline-flex items-center border border-white/20 px-4 py-2 text-sm font-semibold text-gray-400 cursor-default select-none';

const allLinks: ComputedRef<PaginationLinksInterfaceInterface[]> = computed(
    (): PaginationLinksInterfaceInterface[] => {
        return links.slice(1, links.length - 1);
    },
);

const isSeparator = (page?: null | number): boolean =>
    page === null || page === undefined;

const getClass = (active: boolean): string => {
    return active
        ? 'relative z-10 inline-flex items-center bg-purple-500 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500'
        : numberClass;
};
</script>
