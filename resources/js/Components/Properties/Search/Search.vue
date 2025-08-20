<template>
    <section class="bg-black px-4 py-8" id="search-property">
        <div class="container mx-auto px-4">
            <div class="mb-12 pl-4 text-left md:pl-36">
                <h1 class="mb-4 text-2xl font-bold text-white md:text-3xl">
                    Find Your Dream Property
                </h1>
                <p class="ml-0 max-w-6xl text-gray-400">
                    Welcome to Real estate, where your dream property awaits in
                    every corner of our beautiful world. Explore our curated
                    selection of properties, each offering a unique story and a
                    chance to redefine your life. With categories to suit every
                    dreamer, your journey.
                </p>
            </div>

            <div class="mx-auto mb-6 max-w-4xl py-8">
                <div class="relative">
                    <input
                        type="text"
                        v-model="search"
                        placeholder="Search For A Property"
                        class="w-full truncate rounded-lg bg-[#111] py-4 pl-16 pr-16 text-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600 sm:pr-40"
                        @keyup.enter="applyFilters()"
                    />
                    <button
                        @click="clearFilters()"
                        type="button"
                        :disabled="doesntHaveActiveFilters"
                        class="pointer-events-auto absolute left-2 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-lg bg-purple-500 text-white shadow-lg ring-1 ring-purple-300/60 hover:bg-purple-600 hover:ring-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-400"
                        :class="{
                            'cursor-not-allowed hover:bg-purple-600 hover:ring-purple-300/60':
                                doesntHaveActiveFilters,
                            'cursor-pointer': hasActiveFilters,
                        }"
                        aria-label="Clear filters"
                        :aria-disabled="doesntHaveActiveFilters"
                        title="Clear filters"
                    >
                        <TrashIcon class="h-5 w-5 text-white" />
                    </button>
                    <button
                        @click="applyFilters()"
                        type="button"
                        :disabled="isSearching"
                        class="absolute right-2 top-1/2 flex -translate-y-1/2 items-center gap-2 rounded-lg bg-purple-600 px-3 py-3 text-xs font-medium text-white hover:bg-purple-700 sm:px-6 sm:text-sm"
                        :class="{
                            'cursor-not-allowed opacity-70': isSearching,
                            'cursor-pointer': !isSearching,
                        }"
                        :aria-busy="isSearching ? 'true' : 'false'"
                    >
                        <SearchIcon class="text-white" />
                        <span class="hidden sm:inline">{{
                            isSearching ? 'Searching....' : 'Find Property'
                        }}</span>
                    </button>
                </div>
            </div>

            <WhenVisible
                :data="['properties', 'locations', 'types', 'filters']"
            >
                <template #fallback>
                    <Transition
                        appear
                        enter-active-class="transition-all duration-200 ease-out"
                        enter-from-class="opacity-0 scale-95"
                        enter-to-class="opacity-100 scale-100"
                        leave-active-class="transition-all duration-200 ease-in"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div class="animate-pulse py-8" aria-hidden="true">
                            <div
                                class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5"
                            >
                                <div
                                    v-for="skeletonFilterCard in 5"
                                    :key="skeletonFilterCard"
                                    class="rounded-lg bg-[#0f0f0f] p-4 ring-1 ring-gray-800"
                                >
                                    <div
                                        class="mb-3 h-5 w-24 rounded bg-gray-700/50"
                                    ></div>
                                    <div
                                        class="h-8 w-full rounded bg-gray-700/30"
                                    ></div>
                                </div>
                            </div>

                            <div
                                class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3"
                            >
                                <div
                                    v-for="visibleSkeletonCard in visibleSkeletonCards"
                                    :key="visibleSkeletonCard"
                                    class="overflow-hidden rounded-xl bg-[#0f0f0f] ring-1 ring-gray-800"
                                >
                                    <div
                                        class="h-40 w-full bg-gray-700/30"
                                    ></div>
                                    <div class="space-y-2 p-4">
                                        <div
                                            class="h-4 w-3/4 rounded bg-gray-700/50"
                                        ></div>
                                        <div
                                            class="h-4 w-1/2 rounded bg-gray-700/40"
                                        ></div>
                                        <div
                                            class="mt-4 h-8 w-24 rounded bg-gray-700/30"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Transition>
                </template>

                <Transition
                    appear
                    enter-active-class="transition-opacity duration-200 ease-out"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="transition-opacity duration-200 ease-in"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div>
                        <div
                            class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5"
                        >
                            <SearchFilterCard
                                v-for="filterCard in filterCards"
                                :key="filterCard.id"
                                :card="filterCard"
                                :selected-value="getSelectedValue(filterCard)"
                                @option-selected="handleOptionSelected"
                            />
                        </div>

                        <Properties
                            :properties="properties"
                            :filters="filters"
                        />
                    </div>
                </Transition>
            </WhenVisible>
        </div>
    </section>
</template>

<script setup lang="ts">
import SearchIcon from '@/Components/Icons/SearchIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import Properties from '@/Components/Properties/Search/Properties/Properties.vue';
import SearchFilterCard from '@/Components/Properties/Search/SearchFilterCard.vue';
import { index } from '@/Routes/actions/App/Http/Controllers/PropertyController';
import { ScreenSizeEnum } from '@/Types/App/Enums/ScreenSizeEnum';
import { FilterInterface } from '@/Types/App/Interfaces/FilterInterface';
import { IndexPropertyPaginatedInterface } from '@/Types/App/Interfaces/IndexPropertyPaginatedInterface';
import { PropertyAreaRangeInterface } from '@/Types/App/Interfaces/PropertyAreaRangeInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyPriceRangeInterface } from '@/Types/App/Interfaces/PropertyPriceRangeInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { ScreenSizeConfigInterface } from '@/Types/App/Interfaces/ScreenSizeConfigInterface';
import { SearchFilterCardInterface } from '@/Types/App/Interfaces/SearchFilterCardInterface';
import { SearchFilterOptionInterface } from '@/Types/App/Interfaces/SearchFilterOptionInterface';
import { router, WhenVisible } from '@inertiajs/vue3';
import {
    computed,
    onMounted,
    onUnmounted,
    Ref,
    ref,
    type ComputedRef,
} from 'vue';
import { toast } from 'vue3-toastify';

const {
    areas,
    locations,
    prices,
    types,
    filters,
}: {
    areas: PropertyAreaRangeInterface[];
    locations: PropertyLocationInterface[];
    prices: PropertyPriceRangeInterface[];
    types: PropertyTypeInterface[];
    filters: FilterInterface;
} = defineProps<{
    properties: IndexPropertyPaginatedInterface;
    areas: PropertyAreaRangeInterface[];
    locations: PropertyLocationInterface[];
    prices: PropertyPriceRangeInterface[];
    types: PropertyTypeInterface[];
    filters: FilterInterface;
}>();

const page: Ref<number | undefined> = ref<number | undefined>(
    (filters as any)?.page ?? undefined,
);

const search: Ref<string | undefined> = ref<string | undefined>(
    (filters as any)?.search ?? undefined,
);
const location: Ref<string | undefined> = ref<string | undefined>(
    (filters as any)?.location ?? undefined,
);
const type: Ref<string | undefined> = ref<string | undefined>(
    (filters as any)?.type ?? undefined,
);

const price: Ref<string | undefined> = ref<string | undefined>(
    (filters as any)?.price ?? undefined,
);

const area: Ref<string | undefined> = ref<string | undefined>(
    (filters as any)?.area ?? undefined,
);

const isFeatured: Ref<boolean | undefined> = ref<boolean | undefined>(
    (filters as any)?.isFeatured ?? undefined,
);

const isSearching: Ref<boolean> = ref<boolean>(false);

const applyFilters = (fromClearingFilters: boolean = false): void => {
    if (isSearching.value) {
        return;
    }

    const query = {
        page: undefined,
        search: search.value?.trim(),
        location: location.value,
        type: type.value,
        price: price.value,
        area: area.value,
        isFeatured: isFeatured.value,
    } as const;

    router.get(
        index.url({ query }),
        {},
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            onStart: (): void => {
                isSearching.value = true;
            },
            onFinish: (): void => {
                isSearching.value = false;
            },
            onSuccess: (): void => {
                const message: string = fromClearingFilters
                    ? 'Filters cleared.'
                    : 'Search applied.';

                toast.success(message);
            },
        },
    );
};

const selectedFilters = ref<Record<number, SearchFilterOptionInterface>>({});

const handleOptionSelected = (
    cardId: number,
    option: SearchFilterOptionInterface | null,
): void => {
    const updateWith: Record<
        number,
        (option: SearchFilterOptionInterface | null) => void
    > = {
        1: (option: SearchFilterOptionInterface | null) => {
            location.value = option ? String(option.value) : undefined;
        },
        2: (option: SearchFilterOptionInterface | null) => {
            type.value = option ? String(option.value) : undefined;
        },
        3: (option: SearchFilterOptionInterface | null) => {
            price.value = option ? String(option.value) : undefined;
        },
        4: (option: SearchFilterOptionInterface | null) => {
            area.value = option ? String(option.value) : undefined;
        },
        5: (option: SearchFilterOptionInterface | null) => {
            isFeatured.value = option ? Boolean(option.value) : undefined;
        },
    };

    if (option === null) {
        delete selectedFilters.value[cardId];
    } else {
        selectedFilters.value[cardId] = option;
    }

    updateWith[cardId]?.(option);
};

const getSelectedValue = (
    card: SearchFilterCardInterface,
): string | boolean | null => {
    const valueById: Record<number, () => string | boolean | null> = {
        1: () => location.value ?? null,
        2: () => type.value ?? null,
        3: () => price.value ?? null,
        4: () => area.value ?? null,
        5: () => isFeatured.value ?? null,
    };

    return valueById[card.id]?.() ?? null;
};

const hasActiveFilters: Ref<boolean> = computed<boolean>((): boolean => {
    const isSearchActive: boolean = (search.value ?? '').trim().length > 0;

    const filters: (boolean | number | string | undefined)[] = [
        page.value,
        location.value,
        type.value,
        price.value,
        area.value,
        isFeatured.value,
    ];

    const hasActiveAnyFilter: boolean = filters.some(
        (filter: boolean | number | string | undefined): boolean =>
            filter !== undefined,
    );

    const hasActiveAnySelectedFilter: boolean =
        Object.keys(selectedFilters.value).length > 0;

    return isSearchActive || hasActiveAnyFilter || hasActiveAnySelectedFilter;
});

const doesntHaveActiveFilters: Ref<boolean> = computed<boolean>(
    (): boolean => !hasActiveFilters.value,
);

const clearFilters = (): void => {
    page.value = undefined;
    search.value = '';
    location.value = undefined;
    type.value = undefined;
    price.value = undefined;
    area.value = undefined;
    isFeatured.value = undefined;
    selectedFilters.value = {};

    applyFilters(true);
};

const filterCards: SearchFilterCardInterface[] = [
    {
        id: 1,
        icon: 'LocalizationIcon',
        label: 'Location',
        options: locations,
    },
    {
        id: 2,
        icon: 'HouseIcon',
        label: 'Property Type',
        options: types,
    },
    {
        id: 3,
        icon: 'MoneyIcon',
        label: 'Pricing Range',
        options: prices,
    },
    {
        id: 4,
        icon: 'ChartIcon',
        label: 'Property Size',
        options: areas,
    },
    {
        id: 5,
        icon: 'ThunderIcon',
        label: 'Featured',
        options: [
            { label: 'Yes', value: true },
            { label: 'No', value: false },
        ],
    },
];

const screenSize = ref<ScreenSizeEnum>(ScreenSizeEnum.DESKTOP);
const resizeTimeout = ref<number | null>(null);

const updateScreenSize = (): void => {
    const screenSizes: ScreenSizeConfigInterface[] = [
        { max: 768, type: ScreenSizeEnum.MOBILE },
        { max: 1024, type: ScreenSizeEnum.TABLET },
    ];

    const width: number =
        typeof window !== 'undefined' ? window.innerWidth : 1920;
    const match = screenSizes.find((cfg) => width < cfg.max);
    screenSize.value =
        match === undefined ? ScreenSizeEnum.DESKTOP : match.type;
};

const handleResize = (): void => {
    if (resizeTimeout.value !== null) {
        window.clearTimeout(resizeTimeout.value);
    }
    resizeTimeout.value = window.setTimeout((): void => {
        updateScreenSize();
    }, 200);
};

const visibleSkeletonCards: ComputedRef<number> = computed((): number => {
    const map: Record<ScreenSizeEnum, number> = {
        [ScreenSizeEnum.MOBILE]: 1,
        [ScreenSizeEnum.TABLET]: 2,
        [ScreenSizeEnum.DESKTOP]: 3,
    };
    return map[screenSize.value] ?? 3;
});

onMounted((): void => {
    updateScreenSize();
    window.addEventListener('resize', handleResize);
});

onUnmounted((): void => {
    if (resizeTimeout.value !== null) {
        window.clearTimeout(resizeTimeout.value);
    }
    window.removeEventListener('resize', handleResize);
});
</script>
