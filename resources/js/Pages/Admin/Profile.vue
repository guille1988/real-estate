<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <form>
                <div class="space-y-12 sm:space-y-16">
                    <div>
                        <h2 class="text-base/7 font-semibold text-white">
                            Profile
                        </h2>
                        <p class="mt-1 max-w-2xl text-sm/6 text-gray-400">
                            This information will be displayed on the admin
                            panel.
                        </p>

                        <div
                            class="mt-10 space-y-8 border-b border-white/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-white/10 sm:border-t sm:border-t-white/10 sm:pb-0"
                        >
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    for="name"
                                    class="block text-sm/6 font-medium text-white sm:pt-1.5"
                                    >Name</label
                                >
                                <div
                                    class="mt-2 w-full max-w-2xl sm:col-span-2 sm:mt-0"
                                >
                                    <div
                                        class="flex w-full max-w-2xl items-center rounded-md outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-purple-500"
                                    >
                                        <TextInput
                                            id="name"
                                            label=""
                                            v-model:modelValue="name"
                                            type="text"
                                            placeholder="Enter your name"
                                            class="w-full"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    for="thumbnail"
                                    class="block text-sm/6 font-medium text-white sm:pt-1.5"
                                    >Thumbnail</label
                                >
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        class="flex max-w-2xl justify-center rounded-lg border border-dashed border-white/25 px-6 py-10"
                                        :class="{
                                            'ring-2 ring-purple-500 ring-offset-2 ring-offset-black':
                                                isDraggingCover,
                                        }"
                                        @dragenter.prevent="onCoverDragEnter"
                                        @dragover.prevent="onCoverDragOver"
                                        @dragleave.prevent="onCoverDragLeave"
                                        @drop.prevent="onCoverDrop"
                                    >
                                        <div class="w-full text-center">
                                            <div
                                                v-if="coverPreview"
                                                class="flex flex-col items-center"
                                            >
                                                <img
                                                    :src="
                                                        coverPreview as string
                                                    "
                                                    alt="Selected cover preview"
                                                    class="mx-auto max-h-56 rounded-md object-cover"
                                                />
                                                <div
                                                    class="mt-4 flex items-center justify-center text-sm/6 text-gray-400"
                                                >
                                                    <label
                                                        for="upload"
                                                        class="relative cursor-pointer rounded-md bg-transparent font-semibold text-purple-400 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-purple-500 hover:text-purple-300"
                                                    >
                                                        <span>Change</span>
                                                        <input
                                                            id="upload"
                                                            type="file"
                                                            accept="image/*"
                                                            class="sr-only"
                                                            @change="
                                                                onCoverSelected
                                                            "
                                                        />
                                                    </label>
                                                </div>
                                            </div>
                                            <template v-else>
                                                <PhotoIcon
                                                    class="mx-auto size-12 text-gray-600"
                                                    aria-hidden="true"
                                                />
                                                <div
                                                    class="mt-4 flex items-center justify-center text-sm/6 text-gray-400"
                                                >
                                                    <label
                                                        for="upload"
                                                        class="relative cursor-pointer rounded-md bg-transparent font-semibold text-purple-400 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-purple-500 hover:text-purple-300"
                                                    >
                                                        <span
                                                            >Upload an
                                                            image</span
                                                        >
                                                        <input
                                                            id="upload"
                                                            type="file"
                                                            accept="image/*"
                                                            class="sr-only"
                                                            @change="
                                                                onCoverSelected
                                                            "
                                                        />
                                                    </label>
                                                    <p class="pl-1">
                                                        or drag and drop
                                                    </p>
                                                </div>
                                                <p
                                                    class="text-xs/5 text-gray-400"
                                                >
                                                    {{ formats }} up to 10MB
                                                </p>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import { PhotoIcon } from '@heroicons/vue/24/solid';
import { onBeforeUnmount, Ref, ref } from 'vue';

defineProps<{
    formats: string;
}>();

const name: Ref<string> = ref<string>('');
const avatarPreview: Ref<string | null> = ref<string | null>(null);
const coverFile: Ref<File | null> = ref<File | null>(null);
const coverPreview: Ref<string | null> = ref<string | null>(null);
const isDraggingCover: Ref<boolean> = ref<boolean>(false);

const setCoverFile = (file: File): void => {
    if (!file.type.startsWith('image/')) {
        return;
    }

    if (coverPreview.value) {
        URL.revokeObjectURL(coverPreview.value);
    }

    coverFile.value = file;
    coverPreview.value = URL.createObjectURL(file);
};

const onCoverSelected = (event: Event): void => {
    const input: HTMLInputElement = event.target as HTMLInputElement;

    const file: File | null =
        input.files && input.files[0] ? input.files[0] : null;

    if (file) {
        setCoverFile(file);
    }
};

const onCoverDragEnter = (): void => {
    isDraggingCover.value = true;
};

const onCoverDragOver = (): void => {
    isDraggingCover.value = true;
};

const onCoverDragLeave = (): void => {
    isDraggingCover.value = false;
};

const onCoverDrop = (event: DragEvent): void => {
    isDraggingCover.value = false;
    const files: FileList | undefined = event.dataTransfer?.files;

    if (!files || files.length === 0) {
        return;
    }

    setCoverFile(files[0]);
};

onBeforeUnmount((): void => {
    if (avatarPreview.value) {
        URL.revokeObjectURL(avatarPreview.value);
    }

    if (coverPreview.value) {
        URL.revokeObjectURL(coverPreview.value);
    }
});
</script>
