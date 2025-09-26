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
                                    label="Name"
                                    column="name"
                                    :url="PropertyController.index().url"
                                />
                                <SortArrow
                                    label="Title"
                                    column="title"
                                    :url="PropertyController.index().url"
                                />
                                <SortArrow
                                    label="Status"
                                    column="status"
                                    :url="PropertyController.index().url"
                                />
                                <SortArrow
                                    label="Role"
                                    column="role"
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
                            <tr v-for="person in people" :key="person.email">
                                <td class="whitespace-nowrap px-4 py-5 text-sm">
                                    <div class="flex items-center">
                                        <div class="size-11 shrink-0">
                                            <img
                                                class="size-11 rounded-full outline outline-white/10"
                                                :src="person.image"
                                                alt=""
                                            />
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-white">
                                                {{ person.name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-5 text-sm text-gray-400"
                                >
                                    <div class="text-white">
                                        {{ person.title }}
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-5 text-sm text-gray-400"
                                >
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-900/30 px-2 py-1 text-xs font-medium text-green-400 ring-1 ring-inset ring-green-500/50"
                                        >Active</span
                                    >
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-5 text-sm text-gray-400"
                                >
                                    {{ person.role }}
                                </td>
                                <td
                                    class="w-0 whitespace-nowrap px-4 py-5 text-left text-sm font-medium"
                                >
                                    <div class="flex items-center gap-3">
                                        <a
                                            href="#"
                                            class="text-purple-400 hover:text-purple-300"
                                        >
                                            <span class="sr-only"
                                                >Show, {{ person.name }}</span
                                            >
                                            <EyeIcon
                                                class="size-6"
                                                aria-hidden="true"
                                            />
                                        </a>
                                        <a
                                            href="#"
                                            class="text-purple-400 hover:text-purple-300"
                                        >
                                            <span class="sr-only"
                                                >Edit, {{ person.name }}</span
                                            >
                                            <PencilSquareIcon
                                                class="size-6"
                                                aria-hidden="true"
                                            />
                                        </a>
                                        <button
                                            type="button"
                                            class="text-purple-400 hover:text-purple-300"
                                        >
                                            <span class="sr-only"
                                                >Delete, {{ person.name }}</span
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
import {
    EyeIcon,
    PencilSquareIcon,
    TrashIcon,
} from '@heroicons/vue/24/outline';
import type { Ref } from 'vue';
import { ref } from 'vue';

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

const people = [
    {
        name: 'Lindsay Walton',
        title: 'Front-end Developer',
        department: 'Optimization',
        email: 'lindsay.walton@example.com',
        role: 'Member',
        image: 'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Courtney Henry',
        title: 'Designer',
        department: 'Intranet',
        email: 'courtney.henry@example.com',
        role: 'Admin',
        image: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Tom Cook',
        title: 'Director of Product',
        department: 'Directives',
        email: 'tom.cook@example.com',
        role: 'Member',
        image: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Whitney Francis',
        title: 'Copywriter',
        department: 'Program',
        email: 'whitney.francis@example.com',
        role: 'Admin',
        image: 'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Leonard Miles',
        title: 'Senior Designer',
        department: 'Mobility',
        email: 'leonard.krasner@example.com',
        role: 'Owner',
        image: 'https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Floyd Miles',
        title: 'Principal Designer',
        department: 'Security',
        email: 'floyd.miles@example.com',
        role: 'Member',
        image: 'https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
];
</script>
