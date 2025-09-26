<template>
    <th
        scope="col"
        class="px-4 py-3.5 text-left text-sm font-semibold text-white"
    >
        <button
            type="button"
            class="group inline-flex items-center gap-1 text-left"
            @click="onClick"
        >
            <span>{{ label }}</span>
            <ChevronDownIcon
                class="size-4 text-purple-500 transition-transform group-hover:text-white"
                :class="{
                    'text-white': isActive,
                    'rotate-180': isActive && sortDirLocal === 'asc',
                }"
                aria-hidden="true"
            />
        </button>
    </th>
</template>

<script setup lang="ts">
import { SortDirection } from '@/Types/Admin/Enums/SortDirection';
import { ChevronDownIcon } from '@heroicons/vue/20/solid';
import { router, usePage } from '@inertiajs/vue3';
import { computed, ComputedRef } from 'vue';

const { label, column, url }: { label: string; column: string; url: string } =
    defineProps<{
        label: string;
        column: string;
        url: string;
    }>();

const sortKey: string = 'sort';
const dirKey: string = 'direction';

const currentSortBy: ComputedRef<null | string> = computed((): null | string =>
    currentQuery().get(sortKey),
);
const currentSortDirRaw: ComputedRef<null | string> = computed(
    (): null | string => currentQuery().get(dirKey),
);
const currentSortDir: ComputedRef<SortDirection> = computed(
    (): SortDirection =>
        currentSortDirRaw.value === SortDirection.ASC
            ? SortDirection.ASC
            : SortDirection.DESC,
);

const isActive: ComputedRef<boolean> = computed(
    (): boolean => currentSortBy.value === column,
);

const sortDirLocal: ComputedRef<SortDirection> = computed(
    (): SortDirection =>
        isActive.value ? currentSortDir.value : SortDirection.DESC,
);

const currentQuery = (): URLSearchParams => {
    return new URL(usePage().url as string, window.location.origin)
        .searchParams;
};

const toObject = (params: URLSearchParams): Record<string, string> => {
    const object: Record<string, string> = {};

    params.forEach((value: string, key: string): void => {
        object[key] = value;
    });

    return object;
};

const onClick = (): void => {
    const params: URLSearchParams = currentQuery();
    const data: Record<string, string> = toObject(params);

    if (isActive.value) {
        data[dirKey] =
            currentSortDir.value === SortDirection.ASC
                ? SortDirection.DESC
                : SortDirection.ASC;
    } else {
        data[sortKey] = column;
        data[dirKey] = SortDirection.DESC;
    }

    router.get(url, data, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
};
</script>
