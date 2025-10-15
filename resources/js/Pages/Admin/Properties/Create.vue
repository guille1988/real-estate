<template>
    <Layout>
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
                                class="min-h-0 flex-1 space-y-8 overflow-auto pb-8"
                                aria-hidden="true"
                            >
                                <div
                                    class="grid animate-pulse grid-cols-1 gap-6 md:grid-cols-2"
                                >
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-10 rounded bg-gray-800/40"
                                    ></div>
                                    <div
                                        class="h-28 rounded bg-gray-800/40 md:col-span-2"
                                    ></div>
                                </div>

                                <div class="space-y-4">
                                    <div
                                        class="flex items-center justify-between"
                                    >
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
                                            <div
                                                class="flex items-center gap-6"
                                            >
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
                            class="min-h-0 flex-1 space-y-8 overflow-auto pb-8"
                        >
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <TextInput
                                    id="caption"
                                    label="Caption"
                                    v-model="form.caption"
                                    type="text"
                                    placeholder="Short caption"
                                />
                                <TextInput
                                    id="title"
                                    label="Title"
                                    v-model="form.title"
                                    type="text"
                                    placeholder="Property title"
                                />
                                <TextInput
                                    id="address"
                                    label="Address"
                                    v-model="form.address"
                                    type="text"
                                    placeholder="Street, City, State"
                                />
                                <DropdownInput
                                    id="type"
                                    label="Type"
                                    v-model="form.type"
                                    :options="typeOptions"
                                    placeholder="Select type"
                                />
                                <DropdownInput
                                    id="location"
                                    label="Location"
                                    v-model="form.location"
                                    :options="locationOptions"
                                    placeholder="Select location"
                                />
                                <TextInput
                                    id="bathrooms"
                                    label="Bathrooms"
                                    v-model="form.bathrooms"
                                    type="number"
                                    placeholder="0"
                                />
                                <TextInput
                                    id="bedrooms"
                                    label="Bedrooms"
                                    v-model="form.bedrooms"
                                    type="number"
                                    placeholder="0"
                                />
                                <TextInput
                                    id="area"
                                    label="Area (sq ft)"
                                    v-model="form.area"
                                    type="number"
                                    placeholder="0"
                                />
                                <TextInput
                                    id="price"
                                    label="Price (USD)"
                                    v-model="form.price"
                                    type="number"
                                    placeholder="0"
                                />
                                <div
                                    class="flex items-center gap-4 md:col-span-2"
                                >
                                    <CheckboxInput
                                        id="is_featured"
                                        label="Featured"
                                        v-model="form.is_featured"
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
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h2
                                        class="text-base font-semibold text-white"
                                    >
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
                                            class="rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white hover:bg-white/20"
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
                                                    v-model="image.is_default"
                                                />
                                                <button
                                                    type="button"
                                                    @click="removeImage(index)"
                                                    class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500"
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
                            class="shadow-xs rounded-md bg-purple-500 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import CheckboxInput from '@/Components/Shared/Inputs/CheckboxInput.vue';
import DropdownInput from '@/Components/Shared/Inputs/DropdownInput.vue';
import ImageInput from '@/Components/Shared/Inputs/ImageInput.vue';
import TextAreaInput from '@/Components/Shared/Inputs/TextAreaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import PropertyController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyController';
import { PropertyLocationEnum } from '@/Types/App/Enums/PropertyLocationEnum';
import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { DropdownInputOptionsInterface } from '@/Types/App/Interfaces/DropdownInputOptionsInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { Link, router, WhenVisible } from '@inertiajs/vue3';
import { onMounted, reactive, ref, Ref } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    errors: ErrorInterface;
}>();

const form = reactive<{
    caption: string;
    title: string;
    description: string;
    address: string;
    type: string | null;
    location: string | null;
    bathrooms: string;
    bedrooms: string;
    area: string;
    price: string;
    is_featured: boolean;
    images: { file: File | null; is_default: boolean }[];
}>({
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
    is_featured: false,
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
        form.images.push({ file, is_default: false });
    });

    input.value = '';
};

const removeImage = (index: number): void => {
    form.images.splice(index, 1);
};

const submit = (): void => {
    const fd = new FormData();

    fd.append('caption', form.caption);
    fd.append('title', form.title);
    fd.append('description', form.description);
    fd.append('address', form.address);
    fd.append('type', form.type ?? '');
    fd.append('location', form.location ?? '');
    fd.append('bathrooms', form.bathrooms);
    fd.append('bedrooms', form.bedrooms);
    fd.append('area', form.area);
    fd.append('price', form.price);
    fd.append('is_featured', form.is_featured ? '1' : '0');

    form.images.forEach((image, index) => {
        if (image.file) {
            fd.append(`images[${index}][file]`, image.file);
        }
        fd.append(`images[${index}][is_default]`, image.is_default ? '1' : '0');
    });

    router.post(PropertyController.store().url, fd);
};

onMounted((): void => {
    displayErrors(errors);
});
</script>
