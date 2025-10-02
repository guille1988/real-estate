<template>
    <div class="flex flex-1 min-h-0 flex-col px-4 sm:px-6 lg:px-8">
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
                    <SearchBar />
                </div>
            </div>
            <div class="mt-4 sm:mt-0 sm:flex-none">
                <div class="flex items-center gap-3">
                    <FilterHandler v-model="filtersOpen" :filters="filters" />
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
                                <TableHeader column="title" />
                                <TableHeader column="bathrooms" />
                                <TableHeader column="bedrooms" />
                                <TableHeader column="type" />
                                <TableHeader column="price" />
                                <TableHeader column="actions" :sort="false" />
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
                                    resource="property"
                                />
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <Pagination v-if="showPagination()" class="mt-auto" />
    </div>
</template>

<script setup lang="ts">
import Actions from '@/Components/Shared/Tables/Fields/Actions.vue';
import Badge from '@/Components/Shared/Tables/Fields/Badge.vue';
import ImageWithText from '@/Components/Shared/Tables/Fields/ImageWithText.vue';
import Text from '@/Components/Shared/Tables/Fields/Text.vue';
import FilterHandler from '@/Components/Shared/Tables/FilterHandler/FilterHandler.vue';
import Pagination from '@/Components/Shared/Tables/Pagination.vue';
import SearchBar from '@/Components/Shared/Tables/SearchBar.vue';
import TableHeader from '@/Components/Shared/Tables/TableHeader.vue';
import { IndexPropertyPaginatedInterface } from '@/Types/Admin/Interfaces/IndexPropertyPaginatedInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { PropertyTypeColors } from '@/Types/App/Enums/PropertyTypeEnum';
import { PropertyBathroomInterface } from '@/Types/App/Interfaces/PropertyBathroomInterface';
import { PropertyBedroomInterface } from '@/Types/App/Interfaces/PropertyBedroomInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { ref, Ref } from 'vue';

const {
    properties,
    types,
    bathrooms,
    bedrooms,
}: {
    properties: IndexPropertyPaginatedInterface;
    bathrooms: PropertyBathroomInterface[];
    bedrooms: PropertyBedroomInterface[];
    types: PropertyTypeInterface[];
} = defineProps<{
    properties: IndexPropertyPaginatedInterface;
    types: PropertyTypeInterface[];
    bathrooms: PropertyBathroomInterface[];
    bedrooms: PropertyBedroomInterface[];
}>();

const paginationPageLimit: number = 7;

const filters: Record<string, SelectFilterOptionType[]> = {
    bathrooms: bathrooms,
    bedrooms: bedrooms,
    types: types,
};

const filtersOpen: Ref<boolean> = ref<boolean>(false);

const showPagination = (): boolean => properties.total > paginationPageLimit;
</script>
