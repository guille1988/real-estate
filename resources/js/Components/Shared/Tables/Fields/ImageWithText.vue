<template>
    <td class="whitespace-nowrap px-4 py-5 text-sm">
        <div class="flex items-center">
            <div class="size-11 shrink-0">
                <button
                    type="button"
                    class="block"
                    @click="openPreview"
                    aria-label="Ver imagen grande"
                >
                    <img
                        class="size-11 cursor-zoom-in rounded-full outline outline-white/10"
                        :src="image"
                        :alt="text"
                    />
                </button>
            </div>
            <div class="ml-4">
                <div class="flex items-center gap-2">
                    <div class="font-medium text-white">
                        {{ text }}
                    </div>
                    <slot name="badge" />
                </div>
            </div>
        </div>

        <!-- Image Preview Modal -->
        <Modal v-model="isPreviewOpen">
            <div class="flex items-center justify-center">
                <img
                    :src="image"
                    :alt="text"
                    class="max-h-[70vh] w-auto max-w-full rounded-md"
                />
            </div>
        </Modal>
    </td>
</template>

<script setup lang="ts">
import Modal from '@/Components/Shared/Modals/Modal.vue';
import { ref, type Ref } from 'vue';

defineProps<{
    image: string;
    text: string;
}>();

const isPreviewOpen: Ref<boolean> = ref<boolean>(false);
const openPreview = (): void => {
    isPreviewOpen.value = true;
};
</script>
