<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <form @submit.prevent="submit()">
                <div class="space-y-12 sm:space-y-16">
                    <div>
                        <div class="flex items-start justify-between">
                            <div>
                                <h2
                                    class="text-base/7 font-semibold text-white"
                                >
                                    Profile
                                </h2>
                                <p
                                    class="mt-1 max-w-2xl text-sm/6 text-gray-400"
                                >
                                    This information will be displayed on the
                                    admin panel.
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button
                                    type="submit"
                                    class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-medium text-white hover:bg-purple-700"
                                    :disabled="form.processing"
                                    :class="{
                                        'cursor-not-allowed opacity-50':
                                            form.processing,
                                    }"
                                >
                                    <span v-if="!form.processing">Save</span>
                                    <span v-else>Saving...</span>
                                </button>
                            </div>
                        </div>

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
                                            v-model:modelValue="form.name"
                                            type="text"
                                            placeholder="Enter your name"
                                            class="w-full"
                                        />
                                    </div>
                                    <div
                                        v-if="form.errors.name"
                                        class="mt-1 text-sm text-red-500 dark:text-red-400"
                                    >
                                        {{ form.errors.name }}
                                    </div>
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    for="email"
                                    class="block text-sm/6 font-medium text-white sm:pt-1.5"
                                    >E-mail</label
                                >
                                <div
                                    class="mt-2 w-full max-w-2xl sm:col-span-2 sm:mt-0"
                                >
                                    <div
                                        class="flex w-full max-w-2xl items-center rounded-md outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-purple-500"
                                    >
                                        <TextInput
                                            id="email"
                                            label=""
                                            v-model:modelValue="form.email"
                                            type="email"
                                            placeholder="Enter your email"
                                            class="w-full"
                                        />
                                    </div>
                                    <div
                                        v-if="form.errors.email"
                                        class="mt-1 text-sm text-red-500 dark:text-red-400"
                                    >
                                        {{ form.errors.email }}
                                    </div>
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    for="password"
                                    class="block text-sm/6 font-medium text-white sm:pt-1.5"
                                    >Password</label
                                >
                                <div
                                    class="mt-2 w-full max-w-2xl sm:col-span-2 sm:mt-0"
                                >
                                    <div
                                        class="flex w-full max-w-2xl items-center rounded-md outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-purple-500"
                                    >
                                        <TextInput
                                            id="password"
                                            label=""
                                            v-model:modelValue="form.password"
                                            type="password"
                                            placeholder="Enter a new password"
                                            class="w-full"
                                        />
                                    </div>
                                    <div
                                        v-if="form.errors.password"
                                        class="mt-1 text-sm text-red-500 dark:text-red-400"
                                    >
                                        {{ form.errors.password }}
                                    </div>
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    for="password_confirmation"
                                    class="block text-sm/6 font-medium text-white sm:pt-1.5"
                                    >Password Confirmation</label
                                >
                                <div
                                    class="mt-2 w-full max-w-2xl sm:col-span-2 sm:mt-0"
                                >
                                    <div
                                        class="flex w-full max-w-2xl items-center rounded-md outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-purple-500"
                                    >
                                        <TextInput
                                            id="passwordConfirmation"
                                            label=""
                                            v-model:modelValue="
                                                form.passwordConfirmation
                                            "
                                            type="password"
                                            placeholder="Confirm your new password"
                                            class="w-full"
                                        />
                                    </div>
                                    <div
                                        v-if="form.errors.passwordConfirmation"
                                        class="mt-1 text-sm text-red-500 dark:text-red-400"
                                    >
                                        {{ form.errors.passwordConfirmation }}
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
                                    <ImageInput
                                        id="thumbnail"
                                        label=""
                                        alt="Thumbnail"
                                        button-text="Change"
                                        v-model:modelValue="form.thumbnail"
                                        :default-image="thumbnail"
                                    />
                                </div>
                                <div
                                    v-if="form.errors.thumbnail"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.thumbnail }}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <p
                                v-if="showSuccessMessage"
                                class="mt-1 text-sm text-green-400"
                            >
                                {{ successMessage }}
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import ImageInput from '@/Components/Shared/Inputs/ImageInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import ProfileController from '@/Routes/actions/App/Http/Controllers/Admin/ProfileController';
import { FormMethodEnum } from '@/Types/Admin/Enums/FormMethodEnum';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { Ref, ref } from 'vue';

const successMessage: string = 'Profile saved successfully.';
const showSuccessMessage: Ref<boolean> = ref<boolean>(false);
const thumbnail: Ref<string | null> = ref<string | null>(null);

const form: InertiaForm<ProfileFormInterface> = useForm<ProfileFormInterface>({
    name: '',
    email: '',
    password: '',
    passwordConfirmation: '',
    thumbnail: null,
});

const clearForm = (): void => {
    form.reset();
    form.clearErrors();
};

const submit = (): void => {
    showSuccessMessage.value = false;

    form.transform((data: ProfileFormInterface): ProfileFormInterface => {
        return {
            ...data,
            _method: FormMethodEnum.PATCH,
        };
    });

    /*
        ForceFormData to upload the file, makes me
        put post-method and spoof to patch later.
     */
    form.post(ProfileController.update().url, {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: (): void => {
            showSuccessMessage.value = true;
            clearForm();
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
