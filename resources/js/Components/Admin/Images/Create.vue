<template>
    <div
        class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col overflow-hidden rounded-xl bg-black p-4 text-white md:p-6"
    >
        <div class="flex min-h-0 flex-1 flex-col">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-white">
                        Create Images
                    </h1>
                    <p class="mt-2 text-sm text-gray-300">
                        Add images to a property
                    </p>
                </div>
                <BackToIndexButton :url="ImageController.index().url" />
            </div>

            <form
                class="mt-8 flex min-h-0 flex-1 flex-col"
                @submit.prevent="submit"
            >
                <div
                    class="min-h-0 flex-1 space-y-8 overflow-auto pb-8 pr-3 md:pr-4"
                >
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <SearchTextInput
                                id="property"
                                label="Property"
                                v-model="form.property"
                                :options="properties"
                                placeholder="Select property"
                            />
                            <div
                                v-if="form.errors.property"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.property }}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-semibold text-white">
                                Images
                            </h2>
                            <div>
                                <input
                                    ref="multiFileInput"
                                    type="file"
                                    class="hidden"
                                    multiple
                                    accept="image/*"
                                    @change="onMultiFiles"
                                />
                                <button
                                    type="button"
                                    @click="openMultiImagePicker"
                                    :disabled="form.processing"
                                    :class="[
                                        'rounded-md px-3 py-2 text-sm font-semibold',
                                        form.processing
                                            ? 'cursor-not-allowed bg-white/10 text-white opacity-50'
                                            : 'bg-white/10 text-white hover:bg-white/20',
                                    ]"
                                >
                                    Add Image
                                </button>
                                <button
                                    type="button"
                                    @click="removeAllImages"
                                    :disabled="
                                        form.processing ||
                                        form.images.length === 0
                                    "
                                    :class="[
                                        'ml-2 rounded-md px-3 py-2 text-sm font-semibold',
                                        form.processing ||
                                        form.images.length === 0
                                            ? 'cursor-not-allowed bg-red-800 text-white opacity-50'
                                            : 'bg-red-800 text-white hover:bg-red-700',
                                    ]"
                                >
                                    Remove all
                                </button>
                            </div>
                        </div>
                        <div
                            v-if="form.errors.images"
                            class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                        >
                            {{ form.errors.images }}
                        </div>
                        <div class="space-y-6">
                            <div
                                v-for="(image, index) in form.images"
                                :key="`image-${index}`"
                                class="rounded-lg border border-white/10 p-4"
                            >
                                <div class="flex items-center gap-6">
                                    <div class="w-48 shrink-0">
                                        <ImageInput
                                            :id="`image-file-${index}`"
                                            label="Image"
                                            v-model="image.file"
                                            :default-image="null"
                                            alt="Preview"
                                            button-text="Select"
                                            :circle="false"
                                        />
                                        <div v-if="image.file" class="mt-2">
                                            <button
                                                type="button"
                                                class="inset-ring inset-ring-white/5 rounded-md bg-indigo-600 px-2 py-1 text-xs font-semibold text-white hover:bg-indigo-400"
                                                @click="
                                                    openPreviewFromIndex(index)
                                                "
                                            >
                                                Preview
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        class="flex flex-1 items-center justify-end gap-8"
                                    >
                                        <CheckboxInput
                                            :id="`image-default-${index}`"
                                            label="Default"
                                            v-model="image.isDefault"
                                            :icon="true"
                                        />
                                        <button
                                            type="button"
                                            @click="removeImage(index)"
                                            :disabled="form.processing"
                                            :class="[
                                                'rounded-md px-3 py-2 text-sm font-semibold',
                                                form.processing
                                                    ? 'cursor-not-allowed bg-red-600 text-white opacity-50'
                                                    : 'bg-red-600 text-white hover:bg-red-500',
                                            ]"
                                        >
                                            Remove
                                        </button>
                                    </div>
                                </div>
                                <div
                                    v-if="form.errors[`images.${index}.file`]"
                                    class="mt-2 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors[`images.${index}.file`] }}
                                </div>
                                <div
                                    v-if="
                                        form.errors[
                                            `images.${index}.is_default`
                                        ]
                                    "
                                    class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                                >
                                    {{
                                        form.errors[
                                            `images.${index}.is_default`
                                        ]
                                    }}
                                </div>
                            </div>
                            <div
                                v-if="form.images.length === 0"
                                class="text-sm text-gray-400"
                            >
                                No images added yet.
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="mt-8 flex flex-shrink-0 justify-end gap-3 border-t border-white/10 pt-8"
                >
                    <button
                        type="submit"
                        :disabled="form.processing || disabled"
                        :class="[
                            'shadow-xs rounded-md px-4 py-2 text-sm font-semibold',
                            form.processing || disabled
                                ? 'cursor-not-allowed bg-purple-500 text-white opacity-50'
                                : 'bg-purple-500 text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500',
                        ]"
                    >
                        <span v-if="form.processing">Saving...</span>
                        <span v-else-if="disabled">Please wait...</span>
                        <span v-else>Save</span>
                    </button>
                </div>

                <!-- Image Preview Modal -->
                <Modal v-model="isPreviewOpen">
                    <div class="flex items-center justify-center">
                        <img
                            v-if="previewSrc"
                            :src="previewSrc"
                            alt="Preview image"
                            class="max-h-[70vh] w-auto max-w-full rounded-md"
                        />
                    </div>
                </Modal>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import CheckboxInput from '@/Components/Shared/Inputs/CheckboxInput.vue';
import ImageInput from '@/Components/Shared/Inputs/ImageInput.vue';
import SearchTextInput from '@/Components/Shared/Inputs/SearchTextInput.vue';
import Modal from '@/Components/Shared/Modals/Modal.vue';
import ImageController from '@/Routes/actions/App/Http/Controllers/Admin/ImageController';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { onBeforeUnmount, ref, Ref, watch } from 'vue';
import { toast } from 'vue3-toastify';

defineProps<{
    properties: SelectFilterOptionType[];
}>();

const disabled: Ref<boolean> = ref<boolean>(false);

const form: InertiaForm<any> = useForm<any>({
    property: '',
    images: [],
});

const multiFileInput: Ref<HTMLInputElement | null> = ref(null);

const openMultiImagePicker = (): void => {
    multiFileInput.value?.click();
};

const onMultiFiles = (event: Event): void => {
    const input = event.target as HTMLInputElement;

    if (!input.files || input.files.length === 0) {
        return;
    }

    Array.from(input.files).forEach((file: File) => {
        form.images.push({ file, isDefault: false });
    });

    input.value = '';
};

const removeImage = (index: number): void => {
    if (form.processing) {
        return;
    }

    const confirmed: boolean = confirm(
        'Are you sure you want to remove this image?',
    );

    if (!confirmed) {
        return;
    }

    form.images.splice(index, 1);
};

const removeAllImages = (): void => {
    if (form.processing || form.images.length === 0) {
        return;
    }

    const confirmed: boolean = confirm(
        'Are you sure you want to remove all images? This action cannot be undone.',
    );

    if (!confirmed) {
        return;
    }

    if (isPreviewOpen.value) {
        isPreviewOpen.value = false;
    }
    if (previewObjectUrl.value) {
        URL.revokeObjectURL(previewObjectUrl.value);
        previewObjectUrl.value = null;
    }
    previewSrc.value = null;

    form.images.splice(0, form.images.length);

    if (multiFileInput.value) {
        multiFileInput.value.value = '';
    }

    if (typeof form.clearErrors === 'function') {
        form.clearErrors();
    }
};

const isPreviewOpen: Ref<boolean> = ref<boolean>(false);
const previewSrc: Ref<string | null> = ref<string | null>(null);
const previewObjectUrl: Ref<string | null> = ref<string | null>(null);

const openPreviewFromIndex = (index: number): void => {
    const image:
        | {
              file: File | string | null;
          }
        | undefined = form.images[index] as
        | { file: File | string | null }
        | undefined;

    if (!image || !image.file) {
        return;
    }

    if (previewObjectUrl.value) {
        URL.revokeObjectURL(previewObjectUrl.value);
        previewObjectUrl.value = null;
    }

    if (image.file instanceof File) {
        previewObjectUrl.value = URL.createObjectURL(image.file);
        previewSrc.value = previewObjectUrl.value;
    } else {
        previewSrc.value = image.file;
    }

    isPreviewOpen.value = !!previewSrc.value;
};

const submit = (): void => {
    if (form.processing || disabled.value) {
        return;
    }

    disabled.value = true;

    form.post('', {
        preserveScroll: true,
        onSuccess: (): void => {
            form.reset();
            toast.success('Property created successfully.');
        },
        onError: (): void => {
            toast.error(
                'There are some errors on the form. Please check and try again.',
            );

            setTimeout((): void => {
                form.clearErrors();
            }, 4000);
        },
        onFinish: (): void => {
            setTimeout(() => {
                disabled.value = false;
            }, 4000);
        },
    });
};

watch(
    (): boolean => isPreviewOpen.value,
    (open: boolean): void => {
        if (!open && previewObjectUrl.value) {
            URL.revokeObjectURL(previewObjectUrl.value);
            previewObjectUrl.value = null;
        }
    },
);

onBeforeUnmount((): void => {
    if (previewObjectUrl.value) {
        URL.revokeObjectURL(previewObjectUrl.value);
        previewObjectUrl.value = null;
    }
});
</script>
