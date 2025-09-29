<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">Properties</h1>
                <p class="mt-2 text-sm text-gray-300">
                    A list of all the properties
                </p>
            </div>
            <div class="mt-4 sm:mt-0 sm:flex-1 sm:px-6">
                <div
                    class="mx-auto w-full max-w-xl sm:max-w-md md:max-w-lg lg:max-w-xl"
                >
                    <SearchBar
                        v-model="search"
                        placeholder="Search properties..."
                        :url="PropertyController.index().url"
                    />
                </div>
            </div>
            <div class="mt-4 sm:mt-0 sm:flex-none">
                <div class="flex items-center gap-3">
                    <Filter
                        v-model="filtersOpen"
                        :count="activeFilters"
                        @apply="applyFilters"
                        @clear="clearFilters"
                    >
                        <SelectFilter
                            v-model="state"
                            label="State"
                            :options="[
                                { label: 'Active', value: 'active' },
                                { label: 'Inactive', value: 'inactive' },
                            ]"
                        />

                        <SelectFilter
                            v-model="role"
                            label="Role"
                            :options="[
                                { label: 'Member', value: 'member' },
                                { label: 'Admin', value: 'admin' },
                                { label: 'Owner', value: 'owner' },
                            ]"
                        />
                    </Filter>

                    <button
                        type="button"
                        class="shadow-xs block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500"
                    >
                        Add property
                    </button>
                </div>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-my-2 overflow-x-auto">
                <div class="inline-block min-w-full py-2 align-middle">
                    <table
                        class="relative min-w-full table-fixed divide-y divide-white/15"
                    >
                        <thead>
                            <tr>
                                <SortArrow
                                    label="Title"
                                    column="title"
                                    :url="PropertyController.index().url"
                                />
                                <SortArrow
                                    label="Bedrooms"
                                    column="bedrooms"
                                    :url="PropertyController.index().url"
                                />
                                <SortArrow
                                    label="Bathrooms"
                                    column="bathrooms"
                                    :url="PropertyController.index().url"
                                />
                                <SortArrow
                                    label="Type"
                                    column="type"
                                    :url="PropertyController.index().url"
                                />
                                <SortArrow
                                    label="Price"
                                    column="price"
                                    :url="PropertyController.index().url"
                                />
                                <th
                                    scope="col"
                                    class="w-0 px-4 py-3.5 text-left text-sm font-semibold text-white"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10 bg-gray-900">
                            <tr
                                v-for="property in properties.data"
                                :key="property.uuid"
                            >
                                <td class="whitespace-nowrap px-4 py-5 text-sm">
                                    <div class="flex items-center">
                                        <div class="size-11 shrink-0">
                                            <img
                                                class="size-11 rounded-full outline outline-white/10"
                                                :src="property.image"
                                                alt=""
                                            />
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-white">
                                                {{ property.title }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-5 text-sm text-gray-400"
                                >
                                    <div class="text-white">
                                        {{ property.bedrooms }}
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-5 text-sm text-gray-400"
                                >
                                    <div class="text-white">
                                        {{ property.bathrooms }}
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-5 text-sm text-gray-400"
                                >
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-900/30 px-2 py-1 text-xs font-medium uppercase text-green-400 ring-1 ring-inset ring-green-500/50"
                                        >{{ property.type }}</span
                                    >
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-5 text-sm text-gray-400"
                                >
                                    {{ property.price }}
                                </td>
                                <td
                                    class="w-0 whitespace-nowrap px-4 py-5 text-left text-sm font-medium"
                                >
                                    <div class="flex items-center gap-3">
                                        <Link
                                            prefetch
                                            href="#"
                                            class="text-purple-400 hover:text-purple-300"
                                        >
                                            <EyeIcon
                                                class="size-6"
                                                aria-hidden="true"
                                            />
                                        </Link>
                                        <Link
                                            prefetch
                                            href="#"
                                            class="text-purple-400 hover:text-purple-300"
                                        >
                                            <PencilSquareIcon
                                                class="size-6"
                                                aria-hidden="true"
                                            />
                                        </Link>
                                        <button
                                            type="button"
                                            class="text-purple-400 hover:text-purple-300"
                                        >
                                            <TrashIcon
                                                class="size-5"
                                                aria-hidden="true"
                                            />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <Pagination />
    </div>
</template>

<script setup lang="ts">
import Filter from '@/Components/Shared/Tables/Filters/Filter.vue';
import SelectFilter from '@/Components/Shared/Tables/Filters/SelectFilter.vue';
import Pagination from '@/Components/Shared/Tables/Pagination.vue';
import SearchBar from '@/Components/Shared/Tables/SearchBar.vue';
import SortArrow from '@/Components/Shared/Tables/SortArrow.vue';
import PropertyController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyController';
import { IndexPropertyPaginatedInterface } from '@/Types/Admin/Interfaces/IndexPropertyPaginatedInterface';
import {
    EyeIcon,
    PencilSquareIcon,
    TrashIcon,
} from '@heroicons/vue/24/outline';
import { Link, router } from '@inertiajs/vue3';
import { onMounted, Ref, ref } from 'vue';

const { properties }: { properties: IndexPropertyPaginatedInterface } =
    defineProps<{
        properties: IndexPropertyPaginatedInterface;
    }>();

const filtersOpen: Ref<boolean> = ref<boolean>(false);
const activeFilters: Ref<number> = ref<number>(0);
const state: Ref<string> = ref<string>('');
const role: Ref<string> = ref<string>('');
const search: Ref<string> = ref<string>('');

const applyFilters = (): void => {
    let totalCount: number = 0;

    const counts: string[] = [state.value, role.value];

    counts.forEach((count: string): void => {
        if (count) {
            totalCount++;
        }
    });

    activeFilters.value = totalCount;
};

const clearFilters = (): void => {
    state.value = '';
    role.value = '';
    activeFilters.value = 0;
};

const clearQueryStrings = (): void => {
    if (window.location.search) {
        router.replace({ url: window.location.pathname });
    }
};

onMounted((): void => clearQueryStrings());
</script>
