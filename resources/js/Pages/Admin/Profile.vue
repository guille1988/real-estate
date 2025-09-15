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
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        class="flex items-center rounded-md outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-purple-600 sm:max-w-md"
                                    >
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="block min-w-0 grow bg-transparent py-1.5 pl-1 pr-3 text-base text-white caret-purple-600 selection:bg-purple-600 selection:text-white placeholder:text-gray-500 focus:outline-none focus-visible:outline-none sm:text-sm/6"
                                            placeholder="test@test.com"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:py-6"
                            >
                                <label
                                    for="thumbnail"
                                    class="block text-sm/6 font-medium text-white"
                                    >Thumbnail</label
                                >
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div class="flex items-center gap-x-3">
                                        <UserCircleIcon
                                            class="size-12 text-gray-500"
                                            aria-hidden="true"
                                        />
                                        <button
                                            type="button"
                                            class="inset-ring inset-ring-white/5 rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white hover:bg-white/20"
                                        >
                                            Change
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    for="photo"
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
                                                    />
                                                </label>
                                                <p class="pl-1">
                                                    or drag and drop
                                                </p>
                                            </div>
                                            <p class="text-xs/5 text-gray-400">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                        </div>
                                    </div>
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
import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid';
</script>
