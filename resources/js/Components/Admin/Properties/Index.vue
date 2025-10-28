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

                    <button
                        v-if="selected.size > 0"
                        type="button"
                        @click="bulkDelete"
                        class="shadow-xs rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500"
                        :title="`Delete Selected (${selected.size})`"
                    >
                        Delete Selected ({{ selected.size }})
                    </button>

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
                                <th scope="col" class="relative w-10 px-4">
                                    <input
                                        type="checkbox"
                                        :checked="allOnPageSelected"
                                        @change="toggleSelectAll"
                                        class="h-4 w-4 rounded border-gray-600 bg-gray-800 text-purple-500 focus:ring-purple-500"
                                        aria-label="Select all on page"
                                    />
                                </th>
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
                                        <td class="relative w-10 px-4">
                                            <div
                                                class="h-4 w-4 rounded bg-gray-800/40"
                                            ></div>
                                        </td>
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
                                    <td class="relative w-10 px-4">
                                        <input
                                            type="checkbox"
                                            :value="property.uuid"
                                            :checked="isSelected(property.uuid)"
                                            @change="
                                                toggleSelection(property.uuid)
                                            "
                                            class="h-4 w-4 rounded border-gray-600 bg-gray-800 text-purple-500 focus:ring-purple-500"
                                            :aria-label="`Select ${property.title}`"
                                        />
                                    </td>
                                    <ImageWithText
                                        :image="property.image"
                                        :text="property.title"
                                    >
                                        <template #badge>
                                            <span
                                                v-if="property.isFeatured"
                                                class="inline-flex items-center rounded-md bg-red-900/30 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-red-400 ring-1 ring-inset ring-red-500/50"
                                            >
                                                Featured
                                            </span>
                                        </template>
                                    </ImageWithText>
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
import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';
import { IndexPropertyInterface } from '@/Types/Admin/Interfaces/IndexPropertyInterface';
import { IndexPropertyPaginatedInterface } from '@/Types/Admin/Interfaces/IndexPropertyPaginatedInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { PropertyTypeColors } from '@/Types/App/Enums/PropertyTypeEnum';
import { PropertyBathroomInterface } from '@/Types/App/Interfaces/PropertyBathroomInterface';
import { PropertyBedroomInterface } from '@/Types/App/Interfaces/PropertyBedroomInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { Link, WhenVisible, router } from '@inertiajs/vue3';
import { Ref, computed, ref } from 'vue';

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

const selected: Ref<Set<string>> = ref<Set<string>>(new Set());

const isSelected = (uuid: string): boolean => selected.value.has(uuid);

const toggleSelection = (uuid: string): void => {
    if (selected.value.has(uuid)) {
        selected.value.delete(uuid);
    } else {
        selected.value.add(uuid);
    }

    selected.value = new Set(selected.value);
};

const allOnPageSelected = computed<boolean>((): boolean => {
    if (!properties?.data?.length) {
        return false;
    }
    return properties.data.every((property: IndexPropertyInterface): boolean =>
        selected.value.has(property.uuid),
    );
});

const toggleSelectAll = (): void => {
    const uuids: string[] = properties.data.map(
        (property: IndexPropertyInterface): string => property.uuid,
    );

    if (uuids.every((uuid: string): boolean => selected.value.has(uuid))) {
        uuids.forEach((uuid: string): boolean => selected.value.delete(uuid));
    } else {
        uuids.forEach((uuid: string): Set<string> => selected.value.add(uuid));
    }

    selected.value = new Set(selected.value);
};

const bulkDeleteConfirmationMessage: string =
    'Are you sure you want to delete the selected properties? This will also remove all images, amenities and pricing details for each property. This action cannot be undone.';

const bulkDelete = (): void => {
    if (selected.value.size === 0) {
        return;
    }

    if (!confirm(bulkDeleteConfirmationMessage)) {
        return;
    }

    router.visit(PropertyController.bulkDestroy().url, {
        method: FormMethodEnum.POST,
        data: { uuids: Array.from(selected.value) },
        onSuccess: (): void => {
            selected.value.clear();
            selected.value = new Set();
            router.reload({ only: ['properties'] });
        },
    });
};
</script>
