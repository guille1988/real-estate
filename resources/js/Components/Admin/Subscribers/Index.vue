<template>
    <div class="flex min-h-0 flex-1 flex-col px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">Subscribers</h1>
                <p class="mt-2 text-sm text-gray-300">
                    A list of all the subscribers
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
                                <TableHeader label="Email" column="email" />
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
                        <WhenVisible :data="['subscribers']">
                            <template #fallback>
                                <Skeleton resource="subscribers" />
                            </template>

                            <tbody class="divide-y divide-white/10 bg-gray-900">
                                <tr
                                    v-for="subscriber in subscribers.data"
                                    :key="subscriber.uuid"
                                >
                                    <td class="relative w-10 px-4">
                                        <input
                                            type="checkbox"
                                            :value="subscriber.uuid"
                                            :checked="
                                                isSelected(subscriber.uuid)
                                            "
                                            @change="
                                                toggleSelection(subscriber.uuid)
                                            "
                                            class="h-4 w-4 rounded border-gray-600 bg-gray-800 text-purple-500 focus:ring-purple-500"
                                            :aria-label="`Select ${subscriber.uuid}`"
                                        />
                                    </td>
                                    <Text :text="subscriber.email" />
                                    <Text
                                        :text="subscriber.createdAt ?? 'N/A'"
                                    />
                                    <Text
                                        :text="subscriber.updatedAt ?? 'N/A'"
                                    />
                                    <Actions
                                        :delete-url="
                                            SubscriberController.destroy(
                                                subscriber.uuid,
                                            ).url
                                        "
                                        resource="subscriber"
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
            :total="subscribers.total"
            :from="subscribers.from"
            :to="subscribers.to"
            :links="subscribers.links"
            :prev-page-url="subscribers.prevPageUrl"
            :next-page-url="subscribers.nextPageUrl"
        />
    </div>
</template>

<script setup lang="ts">
import Actions from '@/Components/Shared/Tables/Fields/Actions.vue';
import Text from '@/Components/Shared/Tables/Fields/Text.vue';
import Pagination from '@/Components/Shared/Tables/Pagination.vue';
import ResetFilters from '@/Components/Shared/Tables/ResetFilters.vue';
import SearchBar from '@/Components/Shared/Tables/SearchBar.vue';
import Skeleton from '@/Components/Shared/Tables/Skeleton.vue';
import TableHeader from '@/Components/Shared/Tables/TableHeader.vue';
import SubscriberController from '@/Routes/actions/App/Http/Controllers/Admin/SubscriberController';
import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';
import { IndexSubscriberInterface } from '@/Types/Admin/Interfaces/IndexSubscriberInterface';
import { IndexSubscriberPaginatedInterface } from '@/Types/Admin/Interfaces/IndexSubscriberPaginatedInterface';
import { WhenVisible, router } from '@inertiajs/vue3';
import { Ref, computed, ref } from 'vue';
import { toast } from 'vue3-toastify';

const {
    subscribers,
}: {
    subscribers: IndexSubscriberPaginatedInterface;
} = defineProps<{
    subscribers: IndexSubscriberPaginatedInterface;
}>();

const showPagination = (): boolean => subscribers.lastPage > 1;

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
    if (!subscribers?.data?.length) {
        return false;
    }
    return subscribers.data.every(
        (subscriber: IndexSubscriberInterface): boolean =>
            selected.value.has(subscriber.uuid),
    );
});

const toggleSelectAll = (): void => {
    const uuids: string[] = subscribers.data.map(
        (subscriber: IndexSubscriberInterface): string => subscriber.uuid,
    );

    if (uuids.every((uuid: string): boolean => selected.value.has(uuid))) {
        uuids.forEach((uuid: string): boolean => selected.value.delete(uuid));
    } else {
        uuids.forEach((uuid: string): Set<string> => selected.value.add(uuid));
    }

    selected.value = new Set(selected.value);
};

const bulkDeleteConfirmationMessage: string =
    'Are you sure you want to delete the selected subscribers?. This action cannot be undone.';

const bulkDelete = (): void => {
    if (selected.value.size === 0) {
        return;
    }

    if (!confirm(bulkDeleteConfirmationMessage)) {
        return;
    }

    router.visit(SubscriberController.bulkDestroy().url, {
        method: FormMethodEnum.POST,
        data: { uuids: Array.from(selected.value) },
        onSuccess: (): void => {
            selected.value.clear();
            selected.value = new Set();
            router.reload({ only: ['subscribers'] });

            toast.success('Subscribers has been deleted successfully');
        },
    });
};
</script>
