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
                        :url="url"
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
                                <TableHeader column="title" :url="url" />
                                <TableHeader column="bathrooms" :url="url" />
                                <TableHeader column="bedrooms" :url="url" />
                                <TableHeader column="type" :url="url" />
                                <TableHeader column="price" :url="url" />
                                <TableHeader
                                    column="actions"
                                    :url="url"
                                    :sort="false"
                                />
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10 bg-gray-900">
                            <tr
                                v-for="property in properties.data"
                                :key="property.uuid"
                            >
                                <ImageWithText
                                    :image="property.image"
                                    :text="property.title"
                                />
                                <Text :text="property.bathrooms" />
                                <Text :text="property.bedrooms" />
                                <Badge
                                    :badge="property.type"
                                    :mapping="PropertyTypeColors"
                                />
                                <Text :text="property.price" />
                                <Actions
                                    show-url="#"
                                    edit-url="#"
                                    delete-url="#"
                                />
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
import Actions from '@/Components/Shared/Tables/Fields/Actions.vue';
import Badge from '@/Components/Shared/Tables/Fields/Badge.vue';
import ImageWithText from '@/Components/Shared/Tables/Fields/ImageWithText.vue';
import Text from '@/Components/Shared/Tables/Fields/Text.vue';
import Filter from '@/Components/Shared/Tables/Filters/Filter.vue';
import SelectFilter from '@/Components/Shared/Tables/Filters/SelectFilter.vue';
import Pagination from '@/Components/Shared/Tables/Pagination.vue';
import SearchBar from '@/Components/Shared/Tables/SearchBar.vue';
import TableHeader from '@/Components/Shared/Tables/TableHeader.vue';
import { IndexPropertyPaginatedInterface } from '@/Types/Admin/Interfaces/IndexPropertyPaginatedInterface';
import { PropertyTypeColors } from '@/Types/App/Enums/PropertyTypeEnum';
import { PageProps } from '@/Types/Core';
import { Page } from '@inertiajs/core';
import { router, usePage } from '@inertiajs/vue3';
import { onMounted, Ref, ref } from 'vue';

const { properties }: { properties: IndexPropertyPaginatedInterface } =
    defineProps<{
        properties: IndexPropertyPaginatedInterface;
    }>();

const page: Page<PageProps> = usePage();
const url: Ref<string> = ref<string>(page.url);
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
