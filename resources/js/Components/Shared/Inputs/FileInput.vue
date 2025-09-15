<template>
    <div
        class="flex max-w-2xl justify-center rounded-lg border border-dashed border-white/25 px-6 py-10"
        :class="{
            'ring-2 ring-purple-500 ring-offset-2 ring-offset-black':
                isDragging,
        }"
        @dragenter.prevent="onDragEnter"
        @dragover.prevent="onDragOver"
        @dragleave.prevent="onDragLeave"
        @drop.prevent="onDrop"
    >
        <div class="w-full text-center">
            <div v-if="internalPreview" class="flex flex-col items-center">
                <div class="mx-auto w-full max-w-xs">
                    <img
                        :src="internalPreview as string"
                        alt="Selected file preview"
                        class="h-40 w-full rounded-md bg-gray-900/50 object-contain"
                    />
                </div>
                <div
                    class="mt-3 flex items-center justify-center text-sm/6 text-gray-400"
                >
                    <label
                        for="file-upload"
                        class="relative cursor-pointer rounded-md bg-transparent font-semibold text-purple-400 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-purple-500 hover:text-purple-300"
                    >
                        <span>Change</span>
                        <input
                            id="file-upload"
                            type="file"
                            :accept="accept"
                            class="sr-only"
                            @change="onSelected"
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
                        for="file-upload"
                        class="relative cursor-pointer rounded-md bg-transparent font-semibold text-purple-400 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-purple-500 hover:text-purple-300"
                    >
                        <span>Upload an image</span>
                        <input
                            id="file-upload"
                            type="file"
                            :accept="accept"
                            class="sr-only"
                            @change="onSelected"
                        />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs/5 text-gray-400">
                    {{ formats }} up to {{ maxSizeMb }}MB
                </p>
            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
import { PhotoIcon } from '@heroicons/vue/24/solid';
import { onBeforeUnmount, ref, watch, type Ref } from 'vue';

const {
    previewUrl,
    formats,
    accept,
    maxSizeMb,
}: {
    previewUrl: string | null;
    formats: string;
    accept: string;
    maxSizeMb: number;
} = defineProps<{
    modelValue: File | null;
    previewUrl: string | null;
    formats: string;
    accept: string;
    maxSizeMb: number;
}>();

const isDragging: Ref<boolean> = ref(false);
const internalPreview: Ref<string | null> = ref(previewUrl ?? null);

const emit = defineEmits<{
    (e: 'update:modelValue', value: File | null): void;
    (e: 'update:previewUrl', value: string | null): void;
}>();

watch(
    (): string | null => previewUrl,
    (value: string | null) => {
        internalPreview.value = value ?? null;
    },
);

const setFile = (file: File): void => {
    if (accept.includes('image/') && !file.type.startsWith('image/')) {
        return;
    }

    if (internalPreview.value) {
        URL.revokeObjectURL(internalPreview.value);
    }

    emit('update:modelValue', file);
    const url: string = URL.createObjectURL(file);
    internalPreview.value = url;
    emit('update:previewUrl', url);
};

const onSelected = (event: Event): void => {
    const input: HTMLInputElement = event.target as HTMLInputElement;

    const file: File | null =
        input.files && input.files[0] ? input.files[0] : null;

    if (file) {
        setFile(file);
    }
};

const onDragEnter = (): void => {
    isDragging.value = true;
};

const onDragOver = (): void => {
    isDragging.value = true;
};

const onDragLeave = (): void => {
    isDragging.value = false;
};

const onDrop = (event: DragEvent): void => {
    isDragging.value = false;
    const files: FileList | undefined = event.dataTransfer?.files;

    if (!files || files.length === 0) {
        return;
    }

    setFile(files[0]);
};

onBeforeUnmount((): void => {
    if (internalPreview.value) {
        URL.revokeObjectURL(internalPreview.value);
    }
});
</script>
