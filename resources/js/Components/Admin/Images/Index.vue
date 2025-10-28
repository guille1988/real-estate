<template>
    <div class="flex min-h-0 flex-1 flex-col px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">Images</h1>
                <p class="mt-2 text-sm text-gray-300">
                    A list of all the images of a property
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
                        :href="''"
                        class="shadow-xs block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500"
                    >
                        Add Image
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
                                <TableHeader
                                    label="Property"
                                    column="title"
                                    :sort="false"
                                />
                                <TableHeader
                                    label="Created At"
                                    column="createdAt"
                                />
                                <TableHeader
                                    label="Updated At"
                                    column="updatedAt"
                                />
                                <TableHeader
                                    label="Actions"
                                    column="actions"
                                    :sort="false"
                                />
                            </tr>
                        </thead>
                        <WhenVisible :data="['images']">
                            <template #fallback>
                                <tbody
                                    class="divide-y divide-white/10 bg-gray-900"
                                >
                                    <tr
                                        v-for="n in 7"
                                        :key="`images-skeleton-${n}`"
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
                                    v-for="image in images.data"
                                    :key="image.uuid"
                                >
                                    <td class="relative w-10 px-4">
                                        <input
                                            type="checkbox"
                                            :value="image.uuid"
                                            :checked="isSelected(image.uuid)"
                                            @change="
                                                toggleSelection(image.uuid)
                                            "
                                            class="h-4 w-4 rounded border-gray-600 bg-gray-800 text-purple-500 focus:ring-purple-500"
                                            :aria-label="`Select ${image.property}`"
                                        />
                                    </td>
                                    <ImageWithText
                                        :image="image.url"
                                        :text="image.property"
                                    >
                                        <template #badge>
                                            <span
                                                v-if="image.isDefault"
                                                class="inline-flex items-center rounded-md bg-red-900/30 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wide text-red-400 ring-1 ring-inset ring-red-500/50"
                                            >
                                                Default
                                            </span>
                                        </template>
                                    </ImageWithText>
                                    <Text :text="image.createdAt ?? 'N/A'" />
                                    <Text :text="image.updatedAt ?? 'N/A'" />
                                    <Actions
                                        delete-url="https://www.google.com"
                                        resource="image"
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
            :total="images.total"
            :from="images.from"
            :to="images.to"
            :links="images.links"
            :prev-page-url="images.prevPageUrl"
            :next-page-url="images.nextPageUrl"
        />
    </div>
</template>

<script setup lang="ts">
import Actions from '@/Components/Shared/Tables/Fields/Actions.vue';
import ImageWithText from '@/Components/Shared/Tables/Fields/ImageWithText.vue';
import Text from '@/Components/Shared/Tables/Fields/Text.vue';
import FilterHandler from '@/Components/Shared/Tables/FilterHandler/FilterHandler.vue';
import Pagination from '@/Components/Shared/Tables/Pagination.vue';
import ResetFilters from '@/Components/Shared/Tables/ResetFilters.vue';
import SearchBar from '@/Components/Shared/Tables/SearchBar.vue';
import TableHeader from '@/Components/Shared/Tables/TableHeader.vue';
import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';
import { IndexImageInterface } from '@/Types/Admin/Interfaces/IndexImageInterface';
import { IndexImagePaginatedInterface } from '@/Types/Admin/Interfaces/IndexImagePaginatedInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { Link, WhenVisible, router } from '@inertiajs/vue3';
import { Ref, computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

const {
    images,
}: {
    images: IndexImagePaginatedInterface;
} = defineProps<{
    images: IndexImagePaginatedInterface;
}>();

const isDefault: SelectFilterOptionType[] = [
    { label: 'Yes', value: '1' },
    { label: 'No', value: '0' },
];

const filters: Record<string, SelectFilterOptionType[]> = {
    isDefault: isDefault,
};

const filtersOpen: Ref<boolean> = ref<boolean>(false);

const showPagination = (): boolean => images.lastPage > 1;

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
    if (!images?.data?.length) {
        return false;
    }
    return images.data.every((image: IndexImageInterface): boolean =>
        selected.value.has(image.uuid),
    );
});

const toggleSelectAll = (): void => {
    const uuids: string[] = images.data.map(
        (image: IndexImageInterface): string => image.uuid,
    );

    if (uuids.every((uuid: string): boolean => selected.value.has(uuid))) {
        uuids.forEach((uuid: string): boolean => selected.value.delete(uuid));
    } else {
        uuids.forEach((uuid: string): Set<string> => selected.value.add(uuid));
    }

    selected.value = new Set(selected.value);
};

const bulkDeleteConfirmationMessage: string =
    'Are you sure you want to delete the selected images?. This action cannot be undone.';

const bulkDelete = (): void => {
    if (selected.value.size === 0) {
        return;
    }

    if (!confirm(bulkDeleteConfirmationMessage)) {
        return;
    }

    router.visit('', {
        method: FormMethodEnum.POST,
        data: { uuids: Array.from(selected.value) },
        onSuccess: (): void => {
            selected.value.clear();
            selected.value = new Set();
            router.reload({ only: ['images'] });

            toast.success('Images has been deleted successfully');
        },
    });
};
</script>
