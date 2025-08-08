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
                        class="w-full rounded-lg bg-[#111] px-4 py-4 pr-40 text-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600"
                    />
                    <button
                        @click="applyFilters()"
                        class="absolute right-2 top-1/2 flex -translate-y-1/2 items-center gap-2 rounded-lg bg-purple-600 px-6 py-3 text-sm font-medium text-white hover:bg-purple-700"
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
                    @option-selected="handleOptionSelected"
                />
            </div>

            <Properties :properties="properties" />
        </div>
    </section>
</template>

<script setup lang="ts">
import SearchIcon from '@/Components/Icons/SearchIcon.vue';
import Properties from '@/Components/Properties/Search/Properties/Properties.vue';
import SearchFilterCard from '@/Components/Properties/Search/SearchFilterCard.vue';
import { capitalizeFirstLetter } from '@/Composables/useCapitalization';
import { index } from '@/Routes/actions/App/Http/Controllers/PropertyController';
import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { FilterInterface } from '@/Types/App/Interfaces/FilterInterface';
import { IndexPropertyInterface } from '@/Types/App/Interfaces/IndexPropertyInterface';
import { SearchFilterCardInterface } from '@/Types/App/Interfaces/SearchFilterCardInterface';
import { SearchFilterOptionInterface } from '@/Types/App/Interfaces/SearchFilterOptionInterface';
import { router } from '@inertiajs/vue3';
import { Ref, ref } from 'vue';

const { filters }: { filters: FilterInterface } = defineProps<{
    properties: IndexPropertyInterface[];
    filters: FilterInterface;
}>();

const search: Ref<string> = ref<string>(filters.search || '');

const applyFilters = (): void => {
    router.get(
        index().url,
        {
            search: search.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        },
    );
};

const propertyTypes: SearchFilterOptionInterface[] = Object.values(
    PropertyTypeEnum,
).map(
    (value: PropertyTypeEnum, index: number): SearchFilterOptionInterface => ({
        id: index + 1,
        label: capitalizeFirstLetter(value),
        value: value,
    }),
);

const selectedFilters = ref<Record<number, SearchFilterOptionInterface>>({});

const handleOptionSelected = (
    cardId: number,
    option: SearchFilterOptionInterface,
): void => {
    selectedFilters.value[cardId] = option;
};

const filterCards: SearchFilterCardInterface[] = [
    {
        id: 1,
        icon: 'LocalizationIcon',
        label: 'Location',
        options: [
            { id: 1, label: 'New York', value: 'new_york' },
            { id: 2, label: 'Los Angeles', value: 'los_angeles' },
            { id: 3, label: 'Chicago', value: 'chicago' },
            { id: 4, label: 'Miami', value: 'miami' },
            { id: 5, label: 'San Francisco', value: 'san_francisco' },
        ],
    },
    {
        id: 2,
        icon: 'HouseIcon',
        label: 'Property Type',
        options: propertyTypes,
    },
    {
        id: 3,
        icon: 'MoneyIcon',
        label: 'Pricing Range',
        options: [
            { id: 1, label: '$100,000 - $300,000', value: '100000-300000' },
            { id: 2, label: '$300,000 - $500,000', value: '300000-500000' },
            { id: 3, label: '$500,000 - $800,000', value: '500000-800000' },
            { id: 4, label: '$800,000 - $1,200,000', value: '800000-1200000' },
            { id: 5, label: '$1,200,000+', value: '1200000-plus' },
        ],
    },
    {
        id: 4,
        icon: 'ChartIcon',
        label: 'Property Size',
        options: [
            { id: 1, label: '500 - 1,000 sq ft', value: '500-1000' },
            { id: 2, label: '1,000 - 1,500 sq ft', value: '1000-1500' },
            { id: 3, label: '1,500 - 2,000 sq ft', value: '1500-2000' },
            { id: 4, label: '2,000 - 3,000 sq ft', value: '2000-3000' },
            { id: 5, label: '3,000+ sq ft', value: '3000-plus' },
        ],
    },
    {
        id: 5,
        icon: 'ThunderIcon',
        label: 'Featured',
        options: [
            { id: 1, label: 'Yes', value: true },
            { id: 2, label: 'No', value: false },
        ],
    },
];
</script>
