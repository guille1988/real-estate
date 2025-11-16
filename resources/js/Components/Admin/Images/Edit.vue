<template>
    <div class="flex min-h-0 flex-1 flex-col">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-white">Edit Image</h1>
                <p class="mt-2 text-sm text-gray-300">Edit an image</p>
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

                    <div class="flex items-center md:pt-6">
                        <CheckboxInput
                            id="isDefault"
                            label="Is Default?"
                            v-model="form.isDefault"
                            text-class="text-sm ml-1"
                            :icon="true"
                        />
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
import CheckboxInput from '@/Components/Shared/Inputs/CheckboxInput.vue';
import SearchTextInput from '@/Components/Shared/Inputs/SearchTextInput.vue';
import ImageController from '@/Routes/actions/App/Http/Controllers/Admin/ImageController';
import { EditImageInterface } from '@/Types/Admin/Interfaces/EditImageInterface';
import { UpdateImageInterface } from '@/Types/Admin/Interfaces/UpdateImageInterface';
import { SelectFilterOptionType } from '@/Types/Admin/Types/SelectFilterOptionType';
import { InertiaForm, router, useForm } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';
import { toast } from 'vue3-toastify';

const { image }: { image: EditImageInterface } = defineProps<{
    image: EditImageInterface;
    properties: SelectFilterOptionType[];
}>();

const disabled: Ref<boolean> = ref<boolean>(false);

const form: InertiaForm<UpdateImageInterface> = useForm<UpdateImageInterface>({
    property: image.property,
    isDefault: image.isDefault,
});

const submit = (): void => {
    if (form.processing || disabled.value) {
        return;
    }

    disabled.value = true;

    form.put('', {
        preserveScroll: true,
        onSuccess: (): void => {
            router.reload();
            toast.success('Image updated successfully.');
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
