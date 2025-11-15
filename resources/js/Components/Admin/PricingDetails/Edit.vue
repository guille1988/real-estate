<template>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">
                    Edit Pricing Detail
                </h1>
                <p class="mt-2 text-sm text-gray-300">Edit a pricing detail</p>
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
                        <TextInput
                            id="name"
                            label="Name"
                            v-model="form.name"
                            type="text"
                            placeholder="Pricing detail name"
                        />
                        <div
                            v-if="form.errors.name"
                            class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                        >
                            {{ form.errors.name }}
                        </div>
                    </div>

                    <div class="md:col-start-2">
                        <div class="grid grid-cols-2 gap-4">
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
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <TextAreaInput
                            id="description"
                            label="Description"
                            v-model="form.description"
                            :rows="5"
                            placeholder="Describe the pricing detail"
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
                class="mt-8 flex flex-shrink-0 items-center justify-end gap-3 border-t border-white/10 pt-8"
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
</template>

<script setup lang="ts">
import BackToIndexButton from '@/Components/Shared/Buttons/BackToIndexButton.vue';
import DropdownInput from '@/Components/Shared/Inputs/DropdownInput.vue';
import NumericInput from '@/Components/Shared/Inputs/NumericInput.vue';
import TextAreaInput from '@/Components/Shared/Inputs/TextAreaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import PricingDetailController from '@/Routes/actions/App/Http/Controllers/Admin/PricingDetailController';
import { EditPricingDetailInterface } from '@/Types/Admin/Interfaces/EditPricingDetailInterface';
import { PricingDetailCategoryInterface } from '@/Types/Admin/Interfaces/PricingDetailCategoryInterface';
import { InertiaForm, router, useForm } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';
import { toast } from 'vue3-toastify';

const { pricingDetail }: { pricingDetail: EditPricingDetailInterface } =
    defineProps<{
        pricingDetail: EditPricingDetailInterface;
        categories: PricingDetailCategoryInterface[];
    }>();

const disabled: Ref<boolean> = ref<boolean>(false);

const form: InertiaForm<EditPricingDetailInterface> =
    useForm<EditPricingDetailInterface>({
        name: pricingDetail.name,
        category: pricingDetail.category,
        description: pricingDetail.description,
        price: pricingDetail.price,
    });

const submit = (): void => {
    if (form.processing || disabled.value) {
        return;
    }

    disabled.value = true;

    form.patch('', {
        preserveScroll: true,
        onSuccess: (): void => {
            router.reload();
            toast.success('Pricing detail updated successfully.');
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
