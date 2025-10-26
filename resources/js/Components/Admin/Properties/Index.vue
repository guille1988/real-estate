<template>
    <div class="flex min-h-0 flex-1 flex-col px-4 sm:px-6 lg:px-8">
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
                    <ResetFilters />
                    <FilterHandler v-model="filtersOpen" :filters="filters" />
                    <Link
                        prefetch
                        :href="PropertyController.create().url"
                        class="shadow-xs block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500"
                    >
                        Add Property
                    </Link>
                </div>
            </div>
        </div>
        <div class="mt-8 flex min-h-0 flex-1 flex-col">
            <div class="min-h-0 flex-1 overflow-auto">
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
                        <WhenVisible :data="['properties']">
                            <template #fallback>
                                <tbody
                                    class="divide-y divide-white/10 bg-gray-900"
                                >
                                    <tr
                                        v-for="n in 7"
                                        :key="`properties-skeleton-${n}`"
                                    >
                                        <td class="whitespace-nowrap px-4 py-5">
                                            <div
                                                class="flex items-center gap-3"
                                            >
                                                <div
                                                    class="size-11 shrink-0 rounded-full bg-gray-800/60"
                                                ></div>
                                                <div
                                                    class="h-5 w-40 rounded bg-gray-800/40"
                                                ></div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-5">
                                            <div
                                                class="h-5 w-10 rounded bg-gray-800/40"
                                            ></div>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-5">
                                            <div
                                                class="h-5 w-10 rounded bg-gray-800/40"
                                            ></div>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-5">
                                            <div
                                                class="h-6 w-20 rounded-full bg-gray-800/40"
                                            ></div>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-5">
                                            <div
                                                class="h-5 w-16 rounded bg-gray-800/40"
                                            ></div>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-4 py-5 text-right"
                                        >
                                            <div
                                                class="ml-auto flex w-24 justify-end gap-2"
                                            >
                                                <div
                                                    class="h-8 w-8 rounded bg-gray-800/40"
                                                ></div>
                                                <div
                                                    class="h-8 w-8 rounded bg-gray-800/40"
                                                ></div>
                                                <div
                                                    class="h-8 w-8 rounded bg-gray-800/40"
                                                ></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>

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
                                        :show-url="
                                            PropertyController.show(
                                                property.uuid,
                                            ).url
                                        "
                                        :edit-url="
                                            PropertyController.edit(
                                                property.uuid,
                                            ).url
                                        "
                                        :delete-url="
                                            PropertyController.destroy(
                                                property.uuid,
                                            ).url
                                        "
                                        resource="property"
                                        :delete-confirmation-message="
                                            deleteConfirmationMessage
                                        "
                                    />
                                </tr>
                            </tbody>
                        </WhenVisible>
                    </table>
                </div>
            </div>
        </div>
        <Pagination
            v-if="showPagination()"
            class="flex-shrink-0"
            :total="properties.total"
            :from="properties.from"
            :to="properties.to"
            :links="properties.links"
            :prev-page-url="properties.prevPageUrl"
            :next-page-url="properties.nextPageUrl"
        />
    </div>
</template>

<script setup lang="ts">
import Actions from '@/Components/Shared/Tables/Fields/Actions.vue';
import Badge from '@/Components/Shared/Tables/Fields/Badge.vue';
import ImageWithText from '@/Components/Shared/Tables/Fields/ImageWithText.vue';
import Text from '@/Components/Shared/Tables/Fields/Text.vue';
import FilterHandler from '@/Components/Shared/Tables/FilterHandler/FilterHandler.vue';
import Pagination from '@/Components/Shared/Tables/Pagination.vue';
import ResetFilters from '@/Components/Shared/Tables/ResetFilters.vue';
import SearchBar from '@/Components/Shared/Tables/SearchBar.vue';
import TableHeader from '@/Components/Shared/Tables/TableHeader.vue';
import PropertyController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyController';
import { IndexPropertyPaginatedInterface } from '@/Types/Admin/Interfaces/IndexPropertyPaginatedInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { PropertyTypeColors } from '@/Types/App/Enums/PropertyTypeEnum';
import { PropertyBathroomInterface } from '@/Types/App/Interfaces/PropertyBathroomInterface';
import { PropertyBedroomInterface } from '@/Types/App/Interfaces/PropertyBedroomInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { Link, WhenVisible } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';

const {
    properties,
    types,
    bathrooms,
    bedrooms,
    locations,
}: {
    properties: IndexPropertyPaginatedInterface;
    bathrooms: PropertyBathroomInterface[];
    bedrooms: PropertyBedroomInterface[];
    types: PropertyTypeInterface[];
    locations: PropertyLocationInterface[];
} = defineProps<{
    properties: IndexPropertyPaginatedInterface;
    types: PropertyTypeInterface[];
    bathrooms: PropertyBathroomInterface[];
    bedrooms: PropertyBedroomInterface[];
    locations: PropertyLocationInterface[];
}>();

const deleteConfirmationMessage: string =
    'If you continue, you will delete all images, amenities and pricing details related to this property. This action cannot be undone. Are you sure you want to continue?.';

const isFeatured: SelectFilterOptionType[] = [
    { label: 'Yes', value: '1' },
    { label: 'No', value: '0' },
];

const filters: Record<string, SelectFilterOptionType[]> = {
    bathrooms: bathrooms,
    bedrooms: bedrooms,
    type: types,
    location: locations,
    isFeatured: isFeatured,
};

const filtersOpen: Ref<boolean> = ref<boolean>(false);

const showPagination = (): boolean => properties.lastPage > 1;
</script>
