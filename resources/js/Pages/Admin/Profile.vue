<template>
    <Layout>
        <div
            class="inset-ring inset-ring-white/10 flex h-full min-h-0 w-full flex-col rounded-xl bg-black p-4 text-white md:p-6"
        >
            <form>
                <div class="space-y-12 sm:space-y-16">
                    <div>
                        <h2 class="text-base/7 font-semibold text-white">
                            Profile
                        </h2>
                        <p class="mt-1 max-w-2xl text-sm/6 text-gray-400">
                            This information will be displayed on the admin
                            panel.
                        </p>

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
                                            v-model:modelValue="name"
                                            type="text"
                                            placeholder="Enter your name"
                                            class="w-full"
                                        />
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
                                            v-model:modelValue="email"
                                            type="email"
                                            placeholder="Enter your email"
                                            class="w-full"
                                        />
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
                                            v-model:modelValue="password"
                                            type="password"
                                            placeholder="Enter a new password"
                                            class="w-full"
                                        />
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
                                            id="password_confirmation"
                                            label=""
                                            v-model:modelValue="
                                                passwordConfirmation
                                            "
                                            type="password"
                                            placeholder="Confirm your new password"
                                            class="w-full"
                                        />
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
                                    <FileInput
                                        v-model="coverFile"
                                        v-model:previewUrl="coverPreview"
                                        :formats="formats"
                                        accept="image/*"
                                        :max-size-mb="10"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup lang="ts">
import Layout from '@/Components/Admin/Layout/Layout.vue';
import FileInput from '@/Components/Shared/Inputs/FileInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import { Ref, ref } from 'vue';

defineProps<{
    formats: string;
}>();

const name: Ref<string> = ref<string>('');
const email: Ref<string> = ref<string>('');
const password: Ref<string> = ref<string>('');
const passwordConfirmation: Ref<string> = ref<string>('');
const coverFile: Ref<File | null> = ref<File | null>(null);
const coverPreview: Ref<string | null> = ref<string | null>(null);
</script>
