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
                <BackToIndexButton :url="PropertyController.index().url" />
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
                            <TextInput
                                id="title"
                                label="Title"
                                v-model="form.title"
                                type="text"
                                placeholder="Property title"
                            />
                            <div
                                v-if="form.errors.title"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.title }}
                            </div>
                        </div>
                        <div>
                            <TextInput
                                id="caption"
                                label="Caption"
                                v-model="form.caption"
                                type="text"
                                placeholder="Short caption"
                            />
                            <div
                                v-if="form.errors.caption"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.caption }}
                            </div>
                        </div>
                        <div>
                            <TextInput
                                id="address"
                                label="Address"
                                v-model="form.address"
                                type="text"
                                placeholder="Street, City, State"
                            />
                            <div
                                v-if="form.errors.address"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.address }}
                            </div>
                        </div>
                        <div>
                            <DropdownInput
                                id="type"
                                label="Type"
                                v-model="form.type"
                                :options="types"
                                placeholder="Select type"
                            />
                            <div
                                v-if="form.errors.type"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.type }}
                            </div>
                        </div>
                        <div>
                            <DropdownInput
                                id="location"
                                label="Location"
                                v-model="form.location"
                                :options="locations"
                                placeholder="Select location"
                            />
                            <div
                                v-if="form.errors.location"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.location }}
                            </div>
                        </div>
                        <div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <NumericInput
                                        id="bathrooms"
                                        label="Bathrooms"
                                        v-model="form.bathrooms"
                                        placeholder="0"
                                        :accept-negative-numbers="false"
                                    />
                                    <div
                                        v-if="form.errors.bathrooms"
                                        class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                                    >
                                        {{ form.errors.bathrooms }}
                                    </div>
                                </div>
                                <div>
                                    <NumericInput
                                        id="bedrooms"
                                        label="Bedrooms"
                                        v-model="form.bedrooms"
                                        placeholder="0"
                                        :accept-negative-numbers="false"
                                    />
                                    <div
                                        v-if="form.errors.bedrooms"
                                        class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                                    >
                                        {{ form.errors.bedrooms }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <NumericInput
                                id="area"
                                label="Area (sq ft)"
                                v-model="form.area"
                                placeholder="0"
                                :accept-negative-numbers="false"
                            />
                            <div
                                v-if="form.errors.area"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.area }}
                            </div>
                        </div>
                        <div>
                            <NumericInput
                                id="price"
                                label="Price (USD)"
                                v-model="form.price"
                                placeholder="0"
                                :accept-negative-numbers="false"
                            />
                            <div
                                v-if="form.errors.price"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.price }}
                            </div>
                        </div>
                        <div class="flex items-center gap-4 md:col-span-2">
                            <CheckboxInput
                                id="isFeatured"
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
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.description }}
                            </div>
                        </div>
                    </div>
                </div>
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
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import CheckboxInput from '@/Components/Shared/Inputs/CheckboxInput.vue';
import DropdownInput from '@/Components/Shared/Inputs/DropdownInput.vue';
import NumericInput from '@/Components/Shared/Inputs/NumericInput.vue';
import TextAreaInput from '@/Components/Shared/Inputs/TextAreaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import PropertyController from '@/Routes/actions/App/Http/Controllers/Admin/PropertyController';
import type { StorePropertyInterface } from '@/Types/Admin/Interfaces/StorePropertyInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';

defineProps<{
    locations: PropertyLocationInterface[];
    types: PropertyTypeInterface[];
}>();

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
    });

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
