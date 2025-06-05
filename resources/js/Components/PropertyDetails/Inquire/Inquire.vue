<template>
    <section class="w-full bg-black py-16 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="md:col-span-1">
                    <h2 class="mb-4 text-3xl font-medium">
                        Inquire About Seaside<br />Serenity Villa
                    </h2>
                    <p class="text-gray-400">
                        Interested in this property? Fill out the form below,
                        and our real estate experts will get back to you with
                        more details, including scheduling a viewing and
                        answering any questions you may have.
                    </p>
                </div>

                <div class="md:col-span-2">
                    <form
                        @submit.prevent="handleSubmit"
                        class="rounded-lg border border-gray-800 bg-black p-6 shadow-lg"
                    >
                        <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm"
                                    >First Name</label
                                >
                                <input
                                    type="text"
                                    v-model="form.firstName"
                                    placeholder="Enter First Name"
                                    class="w-full rounded-lg border border-gray-800 bg-black px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                                />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm"
                                    >Last Name</label
                                >
                                <input
                                    type="text"
                                    v-model="form.lastName"
                                    placeholder="Enter Last Name"
                                    class="w-full rounded-lg border border-gray-800 bg-black px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                                />
                            </div>
                        </div>

                        <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm">Email</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    placeholder="Enter your Email"
                                    class="w-full rounded-lg border border-gray-800 bg-black px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                                />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm">Phone</label>
                                <input
                                    type="tel"
                                    v-model="form.phone"
                                    placeholder="Enter Phone Number"
                                    class="w-full rounded-lg border border-gray-800 bg-black px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                                />
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-2 block text-sm"
                                >Selected Property</label
                            >
                            <div class="relative">
                                <input
                                    type="text"
                                    v-model="form.property"
                                    readonly
                                    class="w-full rounded-lg border border-gray-800 bg-black px-4 py-3 pr-10 text-white"
                                />
                                <span
                                    class="absolute right-3 top-1/2 -translate-y-1/2 transform"
                                >
                                    <svg
                                        class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="mb-2 block text-sm">Message</label>
                            <textarea
                                v-model="form.message"
                                rows="4"
                                placeholder="Enter your Message here"
                                class="w-full resize-none rounded-lg border border-gray-800 bg-black px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            ></textarea>
                        </div>

                        <div class="mb-6 flex items-center">
                            <input
                                type="checkbox"
                                v-model="form.terms"
                                id="terms"
                                class="h-4 w-4 rounded border-gray-800 bg-black focus:ring-purple-500 focus:ring-offset-black"
                            />
                            <label
                                for="terms"
                                class="ml-2 text-sm text-gray-400"
                            >
                                I agree with
                                <a
                                    href="#"
                                    class="text-white hover:text-purple-500"
                                    >Terms of Use</a
                                >
                                and
                                <a
                                    href="#"
                                    class="text-white hover:text-purple-500"
                                    >Privacy Policy</a
                                >
                            </label>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="rounded-lg bg-purple-600 px-6 py-3 text-white transition-colors duration-200 hover:bg-purple-700"
                            >
                                Send Your Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const form = ref({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    property: 'Seaside Serenity Villa, Malibu, California',
    message: '',
    terms: false,
});

const handleSubmit = (): void => {
    console.log('Form submitted:', form.value);
};
</script>
