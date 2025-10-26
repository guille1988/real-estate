<template>
    <td class="w-0 whitespace-nowrap px-4 py-5 text-left text-sm font-medium">
        <div class="flex items-center gap-3">
            <Link
                v-if="showUrl"
                prefetch
                :title="getTitle(ActionEnum.SHOW)"
                :href="showUrl"
                class="text-purple-400 hover:text-purple-300"
            >
                <EyeIcon class="size-6" aria-hidden="true" />
            </Link>
            <Link
                v-if="editUrl"
                prefetch
                :href="editUrl"
                :title="getTitle(ActionEnum.EDIT)"
                class="text-purple-400 hover:text-purple-300"
            >
                <PencilSquareIcon class="size-6" aria-hidden="true" />
            </Link>
            <button
                v-if="deleteUrl"
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
import { Link, router } from '@inertiajs/vue3';

const {
    deleteUrl,
    resource,
    deleteConfirmationMessage,
}: { deleteUrl: string; resource: string; deleteConfirmationMessage?: string } =
    defineProps<{
        showUrl: string;
        editUrl: string;
        deleteUrl: string;
        resource: string;
        deleteConfirmationMessage?: string;
    }>();

const getTitle = (action: ActionEnum): string => {
    const tooltip: string = `${action} ${resource}`;

    return title(tooltip);
};

const deleteRecord = (): void => {
    const message: string =
        deleteConfirmationMessage ??
        'Are you sure you want to delete this record?.';

    if (!confirm(message)) {
        return;
    }

    router.delete(deleteUrl);
    router.reload();
};
</script>
