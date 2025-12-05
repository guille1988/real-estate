<template>
    <div class="flex min-h-0 flex-1 flex-col px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">Inquiries</h1>
                <p class="mt-2 text-sm text-gray-300">
                    A list of all inquiries for properties.
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
                                <TableHeader
                                    label="First Name"
                                    column="firstName"
                                />
                                <TableHeader
                                    label="Last Name"
                                    column="lastName"
                                />
                                <TableHeader label="Email" column="email" />
                                <TableHeader
                                    label="Phone"
                                    column="phone"
                                    :sort="false"
                                />
                                <TableHeader
                                    label="Read"
                                    column="read"
                                    :sort="false"
                                />
                                <TableHeader
                                    label="Actions"
                                    column="actions"
                                    :sort="false"
                                />
                            </tr>
                        </thead>
                        <WhenVisible :data="['inquiries']">
                            <template #fallback>
                                <Skeleton resource="inquiries" />
                            </template>

                            <tbody class="divide-y divide-white/10 bg-gray-900">
                                <tr
                                    v-for="inquiry in inquiries.data"
                                    :key="inquiry.uuid"
                                >
                                    <td class="relative w-10 px-4">
                                        <input
                                            type="checkbox"
                                            :value="inquiry.uuid"
                                            :checked="isSelected(inquiry.uuid)"
                                            @change="
                                                toggleSelection(inquiry.uuid)
                                            "
                                            class="h-4 w-4 rounded border-gray-600 bg-gray-800 text-purple-500 focus:ring-purple-500"
                                            :aria-label="`Select ${inquiry.email}`"
                                        />
                                    </td>
                                    <ImageWithText
                                        :image="inquiry.propertyDefaultImage"
                                        :text="inquiry.propertyTitle"
                                    />
                                    <Text :text="inquiry.firstName" />
                                    <Text :text="inquiry.lastName" />
                                    <Text :text="inquiry.email" />
                                    <Text :text="inquiry.phone" />
                                    <Badge
                                        :badge="getReadBadge(inquiry.readAt)"
                                        :mapping="badgeColorMapping"
                                    />
                                    <Actions
                                        show-url="https://google.com"
                                        :delete-url="
                                            InquiryController.destroy(
                                                inquiry.uuid,
                                            ).url
                                        "
                                        resource="inquiry"
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
            :total="inquiries.total"
            :from="inquiries.from"
            :to="inquiries.to"
            :links="inquiries.links"
            :prev-page-url="inquiries.prevPageUrl"
            :next-page-url="inquiries.nextPageUrl"
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
import InquiryController from '@/Routes/actions/App/Http/Controllers/Admin/InquiryController';
import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';
import { IndexInquiriesPaginatedInterface } from '@/Types/Admin/Interfaces/IndexInquiriesPaginatedInterface';
import { IndexInquiryInterface } from '@/Types/Admin/Interfaces/IndexInquiryInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { WhenVisible, router } from '@inertiajs/vue3';
import { Ref, computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

const {
    inquiries,
}: {
    inquiries: IndexInquiriesPaginatedInterface;
} = defineProps<{
    inquiries: IndexInquiriesPaginatedInterface;
}>();

const read: SelectFilterOptionType[] = [
    { label: 'Yes', value: '1' },
    { label: 'No', value: '0' },
];

const filters: Record<string, SelectFilterOptionType[]> = {
    read: read,
};

const badgeColorMapping: Record<string, string> = {
    read: 'green',
    unread: 'red',
};

const filtersOpen: Ref<boolean> = ref<boolean>(false);

const getReadBadge = (read: undefined | null | string): string =>
    read === undefined || read === null ? 'unread' : 'read';

const showPagination = (): boolean => inquiries.lastPage > 1;

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
    if (!inquiries?.data?.length) {
        return false;
    }
    return inquiries.data.every((inquiry: IndexInquiryInterface): boolean =>
        selected.value.has(inquiry.uuid),
    );
});

const toggleSelectAll = (): void => {
    const uuids: string[] = inquiries.data.map(
        (inquiry: IndexInquiryInterface): string => inquiry.uuid,
    );

    if (uuids.every((uuid: string): boolean => selected.value.has(uuid))) {
        uuids.forEach((uuid: string): boolean => selected.value.delete(uuid));
    } else {
        uuids.forEach((uuid: string): Set<string> => selected.value.add(uuid));
    }

    selected.value = new Set(selected.value);
};

const bulkDeleteConfirmationMessage: string =
    'Are you sure you want to delete the selected inquiries?. This action cannot be undone.';

const bulkDelete = (): void => {
    if (selected.value.size === 0) {
        return;
    }

    if (!confirm(bulkDeleteConfirmationMessage)) {
        return;
    }

    router.visit(InquiryController.bulkDestroy().url, {
        method: FormMethodEnum.POST,
        data: { uuids: Array.from(selected.value) },
        onSuccess: (): void => {
            selected.value.clear();
            selected.value = new Set();
            router.reload({ only: ['inquiries'] });

            toast.success('Inquiries has been deleted successfully');
        },
    });
};
</script>
