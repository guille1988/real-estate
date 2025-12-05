<template>
    <div class="flex min-h-0 flex-1 flex-col px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">
                    Contact Messages
                </h1>
                <p class="mt-2 text-sm text-gray-300">
                    A list of all contact messages.
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
                                    label="First Name"
                                    column="firstName"
                                />
                                <TableHeader
                                    label="Last Name"
                                    column="lastName"
                                />
                                <TableHeader label="E-mail" column="email" />
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
                                    label="Inquiry Type"
                                    column="inquiryType"
                                />
                                <TableHeader label="Source" column="source" />
                                <TableHeader
                                    label="Actions"
                                    column="actions"
                                    :sort="false"
                                />
                            </tr>
                        </thead>
                        <WhenVisible :data="['contactMessages']">
                            <template #fallback>
                                <Skeleton resource="contact-messages" />
                            </template>

                            <tbody class="divide-y divide-white/10 bg-gray-900">
                                <tr
                                    v-for="contactMessage in contactMessages.data"
                                    :key="contactMessage.uuid"
                                >
                                    <td class="relative w-10 px-4">
                                        <input
                                            type="checkbox"
                                            :value="contactMessage.uuid"
                                            :checked="
                                                isSelected(contactMessage.uuid)
                                            "
                                            @change="
                                                toggleSelection(
                                                    contactMessage.uuid,
                                                )
                                            "
                                            class="h-4 w-4 rounded border-gray-600 bg-gray-800 text-purple-500 focus:ring-purple-500"
                                            :aria-label="`Select ${contactMessage.email}`"
                                        />
                                    </td>
                                    <Text :text="contactMessage.firstName" />
                                    <Text :text="contactMessage.lastName" />
                                    <Text :text="contactMessage.email" />
                                    <Text :text="contactMessage.phone" />
                                    <Badge
                                        :badge="
                                            getReadBadge(contactMessage.readAt)
                                        "
                                        :mapping="badgeColorMapping"
                                    />
                                    <Badge
                                        :badge="contactMessage.inquiryType"
                                        :mapping="
                                            ContactMessageInquiryTypeColors
                                        "
                                    />
                                    <Badge
                                        :badge="contactMessage.source"
                                        :mapping="ContactMessageSourceColors"
                                    />
                                    <Actions
                                        :show-url="
                                            ContactMessageController.show(
                                                contactMessage.uuid,
                                            ).url
                                        "
                                        :delete-url="
                                            ContactMessageController.destroy(
                                                contactMessage.uuid,
                                            ).url
                                        "
                                        resource="contactMessage"
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
            :total="contactMessages.total"
            :from="contactMessages.from"
            :to="contactMessages.to"
            :links="contactMessages.links"
            :prev-page-url="contactMessages.prevPageUrl"
            :next-page-url="contactMessages.nextPageUrl"
        />
    </div>
</template>

<script setup lang="ts">
import Actions from '@/Components/Shared/Tables/Fields/Actions.vue';
import Badge from '@/Components/Shared/Tables/Fields/Badge.vue';
import Text from '@/Components/Shared/Tables/Fields/Text.vue';
import FilterHandler from '@/Components/Shared/Tables/FilterHandler/FilterHandler.vue';
import Pagination from '@/Components/Shared/Tables/Pagination.vue';
import ResetFilters from '@/Components/Shared/Tables/ResetFilters.vue';
import SearchBar from '@/Components/Shared/Tables/SearchBar.vue';
import Skeleton from '@/Components/Shared/Tables/Skeleton.vue';
import TableHeader from '@/Components/Shared/Tables/TableHeader.vue';
import ContactMessageController from '@/Routes/actions/App/Http/Controllers/Admin/ContactMessageController';
import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';
import { IndexContactMessageInterface } from '@/Types/Admin/Interfaces/IndexContactMessageInterface';
import { IndexContactMessagePaginatedInterface } from '@/Types/Admin/Interfaces/IndexContactMessagePaginatedInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { ContactMessageInquiryTypeColors } from '@/Types/App/Enums/ContactMessageInquiryTypeEnum';
import { ContactMessageSourceColors } from '@/Types/App/Enums/ContactMessageSourceEnum';
import { WhenVisible, router } from '@inertiajs/vue3';
import { Ref, computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

const {
    contactMessages,
}: {
    contactMessages: IndexContactMessagePaginatedInterface;
} = defineProps<{
    contactMessages: IndexContactMessagePaginatedInterface;
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

const showPagination = (): boolean => contactMessages.lastPage > 1;

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
    if (!contactMessages?.data?.length) {
        return false;
    }
    return contactMessages.data.every(
        (contactMessage: IndexContactMessageInterface): boolean =>
            selected.value.has(contactMessage.uuid),
    );
});

const toggleSelectAll = (): void => {
    const uuids: string[] = contactMessages.data.map(
        (contactMessage: IndexContactMessageInterface): string =>
            contactMessage.uuid,
    );

    if (uuids.every((uuid: string): boolean => selected.value.has(uuid))) {
        uuids.forEach((uuid: string): boolean => selected.value.delete(uuid));
    } else {
        uuids.forEach((uuid: string): Set<string> => selected.value.add(uuid));
    }

    selected.value = new Set(selected.value);
};

const bulkDeleteConfirmationMessage: string =
    'Are you sure you want to delete the selected contact messages?. This action cannot be undone.';

const bulkDelete = (): void => {
    if (selected.value.size === 0) {
        return;
    }

    if (!confirm(bulkDeleteConfirmationMessage)) {
        return;
    }

    router.visit(ContactMessageController.bulkDestroy().url, {
        method: FormMethodEnum.POST,
        data: { uuids: Array.from(selected.value) },
        onSuccess: (): void => {
            selected.value.clear();
            selected.value = new Set();
            router.reload({ only: ['contactMessages'] });

            toast.success('Contact Messages has been deleted successfully');
        },
    });
};
</script>
