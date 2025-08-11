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
                        class="w-full rounded-lg bg-[#111] py-4 pl-16 pr-40 text-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600"
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
                        class="absolute right-2 top-1/2 flex -translate-y-1/2 cursor-pointer items-center gap-2 rounded-lg bg-purple-600 px-6 py-3 text-sm font-medium text-white hover:bg-purple-700"
                    >
                        <SearchIcon class="text-white" />
                        <span>Find Property</span>
                    </button>
                </div>
            </div>

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

            <Properties :properties="properties" />
        </div>
    </section>
</template>

<script setup lang="ts">
import SearchIcon from '@/Components/Icons/SearchIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import Properties from '@/Components/Properties/Search/Properties/Properties.vue';
import SearchFilterCard from '@/Components/Properties/Search/SearchFilterCard.vue';
import { index } from '@/Routes/actions/App/Http/Controllers/PropertyController';
import { FilterInterface } from '@/Types/App/Interfaces/FilterInterface';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { SearchFilterCardInterface } from '@/Types/App/Interfaces/SearchFilterCardInterface';
import { SearchFilterOptionInterface } from '@/Types/App/Interfaces/SearchFilterOptionInterface';
import { router } from '@inertiajs/vue3';
import { computed, Ref, ref } from 'vue';

const {
    filters,
    locations,
    types,
}: {
    filters: FilterInterface;
    locations: PropertyLocationInterface[];
    types: PropertyTypeInterface[];
} = defineProps<{
    properties: IndexPropertyInterface[];
    locations: PropertyLocationInterface[];
    types: PropertyTypeInterface[];
    filters: FilterInterface;
}>();

const search: Ref<string | undefined> = ref<string | undefined>(
    filters.search || undefined,
);
const location: Ref<string | undefined> = ref<string | undefined>(
    filters.location || undefined,
);
const type: Ref<string | undefined> = ref<string | undefined>(
    filters.type || undefined,
);

const price: Ref<number[] | undefined> = ref<number[] | undefined>(
    filters.price || undefined,
);

const area: Ref<number[] | undefined> = ref<number[] | undefined>(
    filters.area || undefined,
);

const isFeatured: Ref<boolean | undefined> = ref<boolean | undefined>(
    filters.isFeatured || undefined,
);

const applyFilters = (): void => {
    const query = {
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
        5: () => isFeatured.value ?? null,
    };

    return valueById[card.id]?.() ?? null;
};

const hasActiveFilters: Ref<boolean> = computed<boolean>((): boolean => {
    const isSearchActive: boolean = (search.value ?? '').trim().length > 0;

    const filters: (string | boolean | undefined)[] = [
        location.value,
        type.value,
        isFeatured.value,
    ];

    const hasActiveAnyFilter: boolean = filters.some(
        (filter: string | boolean | undefined) => filter !== undefined,
    );

    const hasActiveAnySelectedFilter: boolean =
        Object.keys(selectedFilters.value).length > 0;

    return isSearchActive || hasActiveAnyFilter || hasActiveAnySelectedFilter;
});

const doesntHaveActiveFilters: Ref<boolean> = computed<boolean>(
    (): boolean => !hasActiveFilters.value,
);

const clearFilters = (): void => {
    search.value = '';
    location.value = undefined;
    type.value = undefined;
    isFeatured.value = undefined;
    selectedFilters.value = {};

    applyFilters();
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
        options: [
            { label: '$100,000 - $300,000', value: [100000, 300000] },
            { label: '$300,000 - $500,000', value: [300000, 500000] },
            { label: '$500,000 - $800,000', value: [500000, 800000] },
            { label: '$800,000 - $1,200,000', value: [800000, 1200000] },
            { label: '$1,200,000+', value: [1200000] },
        ],
    },
    {
        id: 4,
        icon: 'ChartIcon',
        label: 'Property Size',
        options: [
            { label: '500 - 1,000 sq ft', value: [500, 1000] },
            { label: '1,000 - 1,500 sq ft', value: [1000, 1500] },
            { label: '1,500 - 2,000 sq ft', value: [1500, 2000] },
            { label: '2,000 - 3,000 sq ft', value: [2000, 3000] },
            { label: '3,000+ sq ft', value: [3000] },
        ],
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
</script>
