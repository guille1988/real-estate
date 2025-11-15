<template>
    <div class="flex min-h-0 flex-1 flex-col px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">
                    Pricing Details
                </h1>
                <p class="mt-2 text-sm text-gray-300">
                    A list of all pricing details for properties.
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
                        :href="PricingDetailController.create().url"
                        class="shadow-xs block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500"
                    >
                        Add Pricing Details
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
                                    column="property"
                                    :sort="false"
                                />
                                <TableHeader label="Name" column="name" />
                                <TableHeader label="Price" column="price" />
                                <TableHeader
                                    label="Category"
                                    column="category"
                                />
                                <TableHeader
                                    label="Actions"
                                    column="actions"
                                    :sort="false"
                                />
                            </tr>
                        </thead>
                        <WhenVisible :data="['pricingDetails']">
                            <template #fallback>
                                <Skeleton resource="pricing-details" />
                            </template>

                            <tbody class="divide-y divide-white/10 bg-gray-900">
                                <tr
                                    v-for="pricingDetail in pricingDetails.data"
                                    :key="pricingDetail.uuid"
                                >
                                    <td class="relative w-10 px-4">
                                        <input
                                            type="checkbox"
                                            :value="pricingDetail.uuid"
                                            :checked="
                                                isSelected(pricingDetail.uuid)
                                            "
                                            @change="
                                                toggleSelection(
                                                    pricingDetail.uuid,
                                                )
                                            "
                                            class="h-4 w-4 rounded border-gray-600 bg-gray-800 text-purple-500 focus:ring-purple-500"
                                            :aria-label="`Select ${pricingDetail.name}`"
                                        />
                                    </td>
                                    <ImageWithText
                                        :image="
                                            pricingDetail.propertyDefaultImage
                                        "
                                        :text="pricingDetail.propertyTitle"
                                    />
                                    <Text :text="pricingDetail.name" />
                                    <Text :text="pricingDetail.price" />
                                    <Badge
                                        :badge="pricingDetail.category"
                                        :mapping="PricingDetailCategoryColors"
                                    />
                                    <Actions
                                        :show-url="
                                            PricingDetailController.show(
                                                pricingDetail.uuid,
                                            ).url
                                        "
                                        :edit-url="
                                            PricingDetailController.edit(
                                                pricingDetail.uuid,
                                            ).url
                                        "
                                        :delete-url="
                                            PricingDetailController.destroy(
                                                pricingDetail.uuid,
                                            ).url
                                        "
                                        resource="pricingDetail"
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
            :total="pricingDetails.total"
            :from="pricingDetails.from"
            :to="pricingDetails.to"
            :links="pricingDetails.links"
            :prev-page-url="pricingDetails.prevPageUrl"
            :next-page-url="pricingDetails.nextPageUrl"
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
import Skeleton from '@/Components/Shared/Tables/Skeleton.vue';
import TableHeader from '@/Components/Shared/Tables/TableHeader.vue';
import PricingDetailController from '@/Routes/actions/App/Http/Controllers/Admin/PricingDetailController';
import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';
import { PricingDetailCategoryColors } from '@/Types/Admin/Enums/PricingDetailCategoryEnum';
import { IndexPricingDetailInterface } from '@/Types/Admin/Interfaces/IndexPricingDetailInterface';
import { IndexPricingDetailsPaginatedInterface } from '@/Types/Admin/Interfaces/IndexPricingDetailsPaginatedInterface';
import { PricingDetailCategoryInterface } from '@/Types/Admin/Interfaces/PricingDetailCategoryInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { Link, WhenVisible, router } from '@inertiajs/vue3';
import { Ref, computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

const {
    pricingDetails,
    categories,
}: {
    pricingDetails: IndexPricingDetailsPaginatedInterface;
    categories: PricingDetailCategoryInterface[];
} = defineProps<{
    pricingDetails: IndexPricingDetailsPaginatedInterface;
    categories: PricingDetailCategoryInterface[];
}>();

const filters: Record<string, SelectFilterOptionType[]> = {
    category: categories,
};

const filtersOpen: Ref<boolean> = ref<boolean>(false);

const showPagination = (): boolean => pricingDetails.lastPage > 1;

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
    if (!pricingDetails?.data?.length) {
        return false;
    }
    return pricingDetails.data.every(
        (pricingDetail: IndexPricingDetailInterface): boolean =>
            selected.value.has(pricingDetail.uuid),
    );
});

const toggleSelectAll = (): void => {
    const uuids: string[] = pricingDetails.data.map(
        (pricingDetail: IndexPricingDetailInterface): string =>
            pricingDetail.uuid,
    );

    if (uuids.every((uuid: string): boolean => selected.value.has(uuid))) {
        uuids.forEach((uuid: string): boolean => selected.value.delete(uuid));
    } else {
        uuids.forEach((uuid: string): Set<string> => selected.value.add(uuid));
    }

    selected.value = new Set(selected.value);
};

const bulkDeleteConfirmationMessage: string =
    'Are you sure you want to delete the selected pricing details?. This action cannot be undone.';

const bulkDelete = (): void => {
    if (selected.value.size === 0) {
        return;
    }

    if (!confirm(bulkDeleteConfirmationMessage)) {
        return;
    }

    router.visit(PricingDetailController.bulkDestroy().url, {
        method: FormMethodEnum.POST,
        data: { uuids: Array.from(selected.value) },
        onSuccess: (): void => {
            selected.value.clear();
            selected.value = new Set();
            router.reload({ only: ['pricingDetails'] });

            toast.success('Pricing Details has been deleted successfully');
        },
    });
};
</script>
