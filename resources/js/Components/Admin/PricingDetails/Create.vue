<template>
    <div
        class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col overflow-hidden rounded-xl bg-black p-4 text-white md:p-6"
    >
        <div class="flex min-h-0 flex-1 flex-col">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-white">
                        Create Pricing Details
                    </h1>
                    <p class="mt-2 text-sm text-gray-300">
                        Add pricing details to a property
                    </p>
                </div>
                <BackToIndexButton :url="PricingDetailController.index().url" />
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
                        <div>
                            <DropdownInput
                                id="category"
                                label="Category"
                                v-model="form.category"
                                :options="categories"
                                placeholder="Select category"
                            />
                            <div
                                v-if="form.errors.category"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.category }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-2">
                            <h2 class="text-sm font-semibold">
                                Pricing details
                            </h2>
                            <div class="flex flex-wrap items-center gap-2">
                                <button
                                    type="button"
                                    @click="addPricingDetail"
                                    :disabled="form.processing"
                                    :class="[
                                        'rounded-md px-3 py-2 text-sm font-semibold text-white',
                                        form.processing
                                            ? 'cursor-not-allowed bg-indigo-600 opacity-50'
                                            : 'bg-indigo-600 hover:bg-indigo-500',
                                    ]"
                                >
                                    Add
                                </button>
                                <button
                                    type="button"
                                    @click="removeAllPricingDetails"
                                    :disabled="
                                        form.processing ||
                                        form.pricingDetails.length === 0
                                    "
                                    :class="[
                                        'rounded-md px-3 py-2 text-sm font-semibold text-white',
                                        form.processing ||
                                        form.pricingDetails.length === 0
                                            ? 'cursor-not-allowed bg-red-800 opacity-50'
                                            : 'bg-red-800 hover:bg-red-700',
                                    ]"
                                >
                                    Remove all
                                </button>
                            </div>
                        </div>

                        <div
                            v-if="
                                form.errors.pricingDetails ||
                                form.errors.pricing_details
                            "
                            class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                        >
                            {{
                                form.errors.pricingDetails ||
                                form.errors.pricing_details
                            }}
                        </div>

                        <div class="mt-4 space-y-6">
                            <div
                                v-for="(detail, index) in form.pricingDetails"
                                :key="`pricing-detail-${index}`"
                                class="flex flex-col rounded-lg border border-white/10 p-4 md:relative"
                            >
                                <button
                                    type="button"
                                    @click="removePricingDetail(index)"
                                    :disabled="form.processing"
                                    :class="[
                                        'mb-3 self-end rounded-md px-3 py-2 text-sm font-semibold md:absolute md:right-4 md:top-4 md:mb-0',
                                        form.processing
                                            ? 'cursor-not-allowed bg-red-600 text-white opacity-50'
                                            : 'bg-red-600 text-white hover:bg-red-500',
                                    ]"
                                >
                                    Remove
                                </button>
                                <div
                                    class="grid grid-cols-1 gap-4 md:grid-cols-3"
                                >
                                    <div>
                                        <TextInput
                                            :id="`pricing-name-${index}`"
                                            label="Name"
                                            v-model="detail.name"
                                            type="text"
                                            placeholder="Enter name"
                                        />
                                        <div
                                            v-if="
                                                form.errors[
                                                    `pricingDetails.${index}.name`
                                                ] ||
                                                form.errors[
                                                    `pricing_details.${index}.name`
                                                ]
                                            "
                                            class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                                        >
                                            {{
                                                form.errors[
                                                    `pricingDetails.${index}.name`
                                                ] ||
                                                form.errors[
                                                    `pricing_details.${index}.name`
                                                ]
                                            }}
                                        </div>
                                    </div>
                                    <div>
                                        <NumericInput
                                            :id="`pricing-price-${index}`"
                                            label="Price"
                                            v-model="detail.price"
                                            placeholder="0"
                                            :accept-negative-numbers="false"
                                        />
                                        <div
                                            v-if="
                                                form.errors[
                                                    `pricingDetails.${index}.price`
                                                ] ||
                                                form.errors[
                                                    `pricing_details.${index}.price`
                                                ]
                                            "
                                            class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                                        >
                                            {{
                                                form.errors[
                                                    `pricingDetails.${index}.price`
                                                ] ||
                                                form.errors[
                                                    `pricing_details.${index}.price`
                                                ]
                                            }}
                                        </div>
                                    </div>
                                    <div class="md:col-span-3">
                                        <TextAreaInput
                                            :id="`pricing-description-${index}`"
                                            label="Description"
                                            v-model="detail.description"
                                            :rows="3"
                                            placeholder="Enter description"
                                        />
                                        <div
                                            v-if="
                                                form.errors[
                                                    `pricingDetails.${index}.description`
                                                ] ||
                                                form.errors[
                                                    `pricing_details.${index}.description`
                                                ]
                                            "
                                            class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                                        >
                                            {{
                                                form.errors[
                                                    `pricingDetails.${index}.description`
                                                ] ||
                                                form.errors[
                                                    `pricing_details.${index}.description`
                                                ]
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-if="form.pricingDetails.length === 0"
                                class="text-sm text-gray-400"
                            >
                                No pricing details added yet.
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
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import DropdownInput from '@/Components/Shared/Inputs/DropdownInput.vue';
import NumericInput from '@/Components/Shared/Inputs/NumericInput.vue';
import SearchTextInput from '@/Components/Shared/Inputs/SearchTextInput.vue';
import TextAreaInput from '@/Components/Shared/Inputs/TextAreaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import PricingDetailController from '@/Routes/actions/App/Http/Controllers/Admin/PricingDetailController';
import { PricingDetailCategoryInterface } from '@/Types/Admin/Interfaces/PricingDetailCategoryInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';
import { toast } from 'vue3-toastify';

defineProps<{
    properties: SelectFilterOptionType[];
    categories: PricingDetailCategoryInterface[];
}>();

const disabled: Ref<boolean> = ref<boolean>(false);

const form: InertiaForm<any> = useForm<any>({
    property: '',
    category: '',
    pricingDetails: [],
});

const addPricingDetail = (): void => {
    if (form.processing) {
        return;
    }
    form.pricingDetails.push({ name: '', description: '', price: '' });
};

const removePricingDetail = (index: number): void => {
    if (form.processing) {
        return;
    }
    const confirmed: boolean = confirm(
        'Are you sure you want to remove this pricing detail?',
    );
    if (!confirmed) {
        return;
    }
    form.pricingDetails.splice(index, 1);
};

const removeAllPricingDetails = (): void => {
    if (form.processing || form.pricingDetails.length === 0) {
        return;
    }
    const confirmed: boolean = confirm(
        'Are you sure you want to remove all pricing details? This action cannot be undone.',
    );
    if (!confirmed) {
        return;
    }
    form.pricingDetails.splice(0, form.pricingDetails.length);
    if (typeof form.clearErrors === 'function') {
        form.clearErrors();
    }
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
            toast.success('Pricing details were created successfully.');
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
</script>
