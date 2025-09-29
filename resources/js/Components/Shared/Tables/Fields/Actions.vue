<template>
    <td class="w-0 whitespace-nowrap px-4 py-5 text-left text-sm font-medium">
        <div class="flex items-center gap-3">
            <Link
                prefetch
                :title="getTitle(ActionEnum.SHOW)"
                :href="showUrl"
                class="text-purple-400 hover:text-purple-300"
            >
                <EyeIcon class="size-6" aria-hidden="true" />
            </Link>
            <Link
                prefetch
                :href="editUrl"
                :title="getTitle(ActionEnum.EDIT)"
                class="text-purple-400 hover:text-purple-300"
            >
                <PencilSquareIcon class="size-6" aria-hidden="true" />
            </Link>
            <button
                :title="getTitle(ActionEnum.DELETE)"
                type="button"
                class="text-purple-400 hover:text-purple-300"
                @click="deleteRecord()"
            >
                <TrashIcon class="size-5" aria-hidden="true" />
            </button>
        </div>
    </td>
</template>

<script setup lang="ts">
import { title } from '@/Composables/useTitleCase';
import { ActionEnum } from '@/Types/Admin/Enums/ActionEnum';
import {
    EyeIcon,
    PencilSquareIcon,
    TrashIcon,
} from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';

const { resource }: { resource: string } = defineProps<{
    showUrl: string;
    editUrl: string;
    deleteUrl: string;
    resource: string;
}>();

const getTitle = (action: ActionEnum): string => {
    const tooltip: string = `${action} ${resource}`;

    return title(tooltip);
};

const deleteRecord = (): void => {
    const isConfirmed: boolean = confirm(
        'Are you sure you want to delete this record?',
    );

    if (!isConfirmed) {
        return;
    }

    // Put logic here for deleting the record.
    console.log('Deleting record...');
};
</script>
