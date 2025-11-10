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
                                id="location"
                                label="Location"
                                v-model="form.category"
                                :options="categories"
                                placeholder="Select location"
                            />
                            <div
                                v-if="form.errors.category"
                                class="mt-1 max-w-full break-words text-sm text-red-500 dark:text-red-400"
                            >
                                {{ form.errors.category }}
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
import SearchTextInput from '@/Components/Shared/Inputs/SearchTextInput.vue';
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

const submit = (): void => {
    if (form.processing || disabled.value) {
        return;
    }

    disabled.value = true;

    form.post('', {
        preserveScroll: true,
        onSuccess: (): void => {
            form.reset();
            toast.success('Images were created successfully.');
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
