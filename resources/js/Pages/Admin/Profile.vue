<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <form @submit.prevent="submit" class="space-y-12 sm:space-y-16">
                <div>
                    <h2 class="text-base/7 font-semibold text-white">
                        Profile
                    </h2>
                    <p class="mt-1 max-w-2xl text-sm/6 text-gray-400">
                        This information will be displayed on the admin panel.
                    </p>

                    <div class="mt-6" v-if="wasSavedSuccessfully">
                        <div
                            class="rounded-md bg-green-500/10 px-4 py-3 text-sm text-green-400 ring-1 ring-inset ring-green-500/20"
                        >
                            {{ successMessage }}
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
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <div
                                    class="flex items-center rounded-md outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-purple-600 sm:max-w-md"
                                >
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="block min-w-0 grow bg-transparent py-1.5 pl-1 pr-3 text-base text-white caret-purple-600 selection:bg-purple-600 selection:text-white placeholder:text-gray-500 focus:outline-none focus-visible:outline-none sm:text-sm/6"
                                        placeholder="Your name"
                                        :disabled="form.processing"
                                    />
                                </div>
                                <p
                                    v-if="form.errors.name"
                                    class="mt-2 text-sm text-red-400"
                                >
                                    {{ form.errors.name }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                        >
                            <label
                                for="thumbnail"
                                class="block text-sm/6 font-medium text-white sm:pt-1.5"
                                >Photo</label
                            >
                            <div class="mt-2 sm:col-span-2 sm:mt-0">
                                <div
                                    class="flex max-w-2xl justify-center rounded-lg border border-dashed border-white/25 px-6 py-10"
                                >
                                    <div class="text-center">
                                        <PhotoIcon
                                            class="mx-auto size-12 text-gray-600"
                                            aria-hidden="true"
                                        />
                                        <div
                                            class="mt-4 flex text-sm/6 text-gray-400"
                                        >
                                            <label
                                                for="thumbnail"
                                                class="relative cursor-pointer rounded-md bg-transparent font-semibold text-purple-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-purple-600 hover:text-purple-300"
                                            >
                                                <span>Upload a file</span>
                                                <input
                                                    id="thumbnail"
                                                    name="thumbnail"
                                                    type="file"
                                                    class="sr-only"
                                                    @change="onFileChange"
                                                    accept="image/*"
                                                    :disabled="form.processing"
                                                />
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs/5 text-gray-400">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                        <p
                                            v-if="form.errors.thumbnail"
                                            class="mt-2 text-sm text-red-400"
                                        >
                                            {{ form.errors.thumbnail }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-x-3">
                    <button
                        type="button"
                        class="inset-ring inset-ring-white/5 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white hover:bg-white/20"
                        @click="form.reset()"
                        :disabled="form.processing"
                    >
                        Reset
                    </button>
                    <button
                        type="submit"
                        class="rounded-md bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600 disabled:opacity-50"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Saving...</span>
                        <span v-else>Save</span>
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import { PhotoIcon } from '@heroicons/vue/24/solid';
import { useForm } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';

const wasSavedSuccessfully: Ref<boolean> = ref<boolean>(false);
const successMessage: string = 'Saved successfully.';

const form = useForm<{ name: string; thumbnail: File | null }>({
    name: '',
    thumbnail: null,
});

const onFileChange = (event: Event): void => {
    const target = event.target as HTMLInputElement;
    form.thumbnail = target.files && target.files[0] ? target.files[0] : null;
};

const submit = (): void => {
    wasSavedSuccessfully.value = false;

    form.patch('#', {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: (): void => {
            form.reset('thumbnail');
            wasSavedSuccessfully.value = true;
        },
    });
};
</script>
