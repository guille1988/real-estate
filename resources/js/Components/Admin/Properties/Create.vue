<template>
    <div
        class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col overflow-hidden rounded-xl bg-black p-4 text-white md:p-6"
    >
        <div class="flex min-h-0 flex-1 flex-col">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-white">
                        Create Property
                    </h1>
                    <p class="mt-2 text-sm text-gray-300">
                        Add a new property and its images
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:flex-none">
                    <Link
                        prefetch
                        :href="PropertyController.index().url"
                        class="shadow-xs block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500"
                    >
                        Back to Index
                    </Link>
                </div>
            </div>

            <form
                class="mt-8 flex min-h-0 flex-1 flex-col"
                @submit.prevent="submit"
            >
                <WhenVisible :data="['createForm']">
                    <template #fallback>
                        <div
                            class="min-h-0 flex-1 space-y-8 overflow-auto pb-8 pr-3 md:pr-4"
                            aria-hidden="true"
                        >
                            <div
                                class="grid animate-pulse grid-cols-1 gap-6 md:grid-cols-2"
                            >
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div class="h-10 rounded bg-gray-800/40"></div>
                                <div
                                    class="h-28 rounded bg-gray-800/40 md:col-span-2"
                                ></div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div
                                        class="h-6 w-40 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-9 w-28 rounded bg-gray-800/40"
                                    ></div>
                                </div>
                                <div class="space-y-6">
                                    <div
                                        class="rounded-lg border border-white/10 p-4"
                                    >
                                        <div class="flex items-center gap-6">
                                            <div class="w-48 shrink-0">
                                                <div
                                                    class="aspect-video w-full rounded bg-gray-800/40"
                                                ></div>
                                            </div>
                                            <div
                                                class="ml-auto flex items-center gap-4"
                                            >
                                                <div
                                                    class="h-5 w-24 rounded bg-gray-800/40"
                                                ></div>
                                                <div
                                                    class="h-9 w-24 rounded bg-gray-800/40"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        Loading form…
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div
                        class="min-h-0 flex-1 space-y-8 overflow-auto pb-8 pr-3 md:pr-4"
                    >
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <TextInput
                                id="caption"
                                label="Caption"
                                v-model="form.caption"
                                type="text"
                                placeholder="Short caption"
                            />
                            <div
                                v-if="form.errors.caption"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.caption }}
                            </div>
                            <TextInput
                                id="title"
                                label="Title"
                                v-model="form.title"
                                type="text"
                                placeholder="Property title"
                            />
                            <div
                                v-if="form.errors.title"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.title }}
                            </div>
                            <TextInput
                                id="address"
                                label="Address"
                                v-model="form.address"
                                type="text"
                                placeholder="Street, City, State"
                            />
                            <div
                                v-if="form.errors.address"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.address }}
                            </div>
                            <DropdownInput
                                id="type"
                                label="Type"
                                v-model="form.type"
                                :options="typeOptions"
                                placeholder="Select type"
                            />
                            <div
                                v-if="form.errors.type"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.type }}
                            </div>
                            <DropdownInput
                                id="location"
                                label="Location"
                                v-model="form.location"
                                :options="locationOptions"
                                placeholder="Select location"
                            />
                            <div
                                v-if="form.errors.location"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.location }}
                            </div>
                            <TextInput
                                id="bathrooms"
                                label="Bathrooms"
                                v-model="form.bathrooms"
                                type="number"
                                placeholder="0"
                            />
                            <div
                                v-if="form.errors.bathrooms"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.bathrooms }}
                            </div>
                            <TextInput
                                id="bedrooms"
                                label="Bedrooms"
                                v-model="form.bedrooms"
                                type="number"
                                placeholder="0"
                            />
                            <div
                                v-if="form.errors.bedrooms"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.bedrooms }}
                            </div>
                            <TextInput
                                id="area"
                                label="Area (sq ft)"
                                v-model="form.area"
                                type="number"
                                placeholder="0"
                            />
                            <div
                                v-if="form.errors.area"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.area }}
                            </div>
                            <TextInput
                                id="price"
                                label="Price (USD)"
                                v-model="form.price"
                                type="number"
                                placeholder="0"
                            />
                            <div
                                v-if="form.errors.price"
                                class="-mt-4 text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.price }}
                            </div>
                            <div class="flex items-center gap-4 md:col-span-2">
                                <CheckboxInput
                                    id="is_featured"
                                    label="Featured"
                                    v-model="form.isFeatured"
                                />
                            </div>
                            <div class="md:col-span-2">
                                <TextAreaInput
                                    id="description"
                                    label="Description"
                                    v-model="form.description"
                                    :rows="5"
                                    placeholder="Describe the property"
                                />
                                <div
                                    v-if="form.errors.description"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.description }}
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
                                </div>
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
                                        </div>
                                        <div
                                            class="flex flex-1 items-center justify-end gap-4"
                                        >
                                            <CheckboxInput
                                                :id="`image-default-${index}`"
                                                label="Default"
                                                v-model="image.isDefault"
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
                </WhenVisible>
                <div
                    class="mt-8 flex flex-shrink-0 justify-end gap-3 border-t border-white/10 pt-8"
                >
                    <button
                        type="submit"
                        :disabled="form.processing"
                        :class="[
                            'shadow-xs rounded-md px-4 py-2 text-sm font-semibold',
                            form.processing
                                ? 'cursor-not-allowed bg-purple-500 text-white opacity-50'
                                : 'bg-purple-500 text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500',
                        ]"
                    >
                        <span v-if="!form.processing">Save</span>
                        <span v-else>Saving...</span>
                    </button>
                    <p v-if="showSuccessMessage" class="text-sm text-green-400">
                        {{ successMessage }}
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import CheckboxInput from '@/Components/Shared/Inputs/CheckboxInput.vue';
import DropdownInput from '@/Components/Shared/Inputs/DropdownInput.vue';
import ImageInput from '@/Components/Shared/Inputs/ImageInput.vue';
import TextAreaInput from '@/Components/Shared/Inputs/TextAreaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import PropertyController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyController';
import type { StorePropertyInterface } from '@/Types/Admin/Interfaces/StorePropertyInterface';
import { PropertyLocationEnum } from '@/Types/App/Enums/PropertyLocationEnum';
import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { DropdownInputOptionsInterface } from '@/Types/App/Interfaces/DropdownInputOptionsInterface';
import { InertiaForm, Link, useForm, WhenVisible } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';

const successMessage: string = 'Property created successfully.';
const showSuccessMessage: Ref<boolean> = ref<boolean>(false);

const form: InertiaForm<StorePropertyInterface> =
    useForm<StorePropertyInterface>({
        caption: '',
        title: '',
        description: '',
        address: '',
        type: null,
        location: null,
        bathrooms: '',
        bedrooms: '',
        area: '',
        price: '',
        isFeatured: false,
        images: [],
    });

const toLabel = (value: string): string =>
    value
        .split('_')
        .map((s: string) => s.charAt(0).toUpperCase() + s.slice(1))
        .join(' ');

const typeOptions: DropdownInputOptionsInterface[] = Object.values(
    PropertyTypeEnum,
).map((value: string) => ({ label: toLabel(value), value }));

const locationOptions: DropdownInputOptionsInterface[] = Object.values(
    PropertyLocationEnum,
).map((value: string) => ({ label: toLabel(value), value }));

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
    form.images.splice(index, 1);
};

const submit = (): void => {
    showSuccessMessage.value = false;

    form.post(PropertyController.store().url, {
        preserveScroll: true,
        onSuccess: (): void => {
            showSuccessMessage.value = true;
            form.reset();

            setTimeout((): void => {
                showSuccessMessage.value = false;
            }, 4000);
        },
        onError: (): void => {
            setTimeout((): void => {
                form.clearErrors();
            }, 4000);
        },
    });
};
</script>
