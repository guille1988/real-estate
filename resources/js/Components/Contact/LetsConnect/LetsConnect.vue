<template>
    <section class="w-full bg-black py-8 text-white" id="lets-connect">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12">
                <ThreeStars />
                <h2 class="mb-4 text-3xl font-medium">Let's Connect</h2>
                <p class="w-full text-gray-400">
                    We're excited to connect with you and learn more about your
                    real estate goals. Use the form below to get in touch with
                    Real estate.
                </p>
                <p class="w-full text-gray-400">
                    Whether you're a prospective client, partner, or simply
                    curious about our services, we're here to answer your
                    questions and provide the assistance you need.
                </p>
            </div>

            <form @submit.prevent="form.post('/')" class="w-full">
                <div class="mb-8 grid gap-6 md:grid-cols-2">
                    <div class="flex flex-col">
                        <label for="first_name" class="mb-3 text-sm text-white"
                            >First Name:
                        </label>
                        <input
                            type="text"
                            id="first_name"
                            v-model="form.first_name"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            placeholder="Enter First Name"
                            required
                        />
                        <div v-if="form.errors.first_name">
                            {{ form.errors.first_name }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label for="last_name" class="mb-3 text-sm text-white"
                            >Last Name:
                        </label>
                        <input
                            type="text"
                            id="last_name"
                            v-model="form.last_name"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            placeholder="Enter Last Name"
                            required
                        />
                        <div v-if="form.errors.last_name">
                            {{ form.errors.last_name }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label for="email" class="mb-3 text-sm text-white"
                            >Email:
                        </label>
                        <input
                            type="email"
                            id="email"
                            v-model="form.email"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            placeholder="Enter Your E-mail"
                            required
                        />
                        <div v-if="form.errors.email">
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label for="phone" class="mb-3 text-sm text-white"
                            >Phone:
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            v-model="form.phone"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            placeholder="Enter Phone Number"
                            required
                        />
                        <div v-if="form.errors.phone">
                            {{ form.errors.phone }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label
                            for="inquiry_type"
                            class="mb-3 text-sm text-white"
                            >Inquiry Type:
                        </label>
                        <select
                            id="inquiry_type"
                            v-model="form.inquiry_type"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white focus:border-purple-500 focus:outline-none"
                            required
                        >
                            <option value="" disabled selected>
                                Select Inquiry Type
                            </option>
                            <option
                                v-for="inquiryType in inquiryTypes"
                                :key="inquiryType.id"
                                :value="inquiryType.value"
                            >
                                {{ inquiryType.label }}
                            </option>
                        </select>

                        <div v-if="form.errors.inquiry_type">
                            {{ form.errors.inquiry_type }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label for="source" class="mb-3 text-sm text-white"
                            >How Did You Hear About Us? :</label
                        >
                        <select
                            id="source"
                            v-model="form.source"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white focus:border-purple-500 focus:outline-none"
                            required
                        >
                            <option value="" disabled selected>Select</option>
                            <option
                                v-for="source in sources"
                                :key="source.id"
                                :value="source.value"
                            >
                                {{ source.label }}
                            </option>
                        </select>
                    </div>
                    <div v-if="form.errors.source">
                        {{ form.errors.source }}
                    </div>
                </div>

                <div class="mb-6 flex flex-col">
                    <label for="message" class="mb-3 text-sm text-white"
                        >Message:
                    </label>
                    <textarea
                        id="message"
                        v-model="form.message"
                        rows="6"
                        class="w-full rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                        placeholder="Enter Your Message Here"
                        required
                    ></textarea>
                    <div v-if="form.errors.message">
                        {{ form.errors.message }}
                    </div>
                </div>

                <div class="mb-8 flex items-start">
                    <input
                        type="checkbox"
                        id="terms"
                        v-model="form.accept_terms"
                        class="mt-1 h-4 w-4 rounded border-neutral-800 bg-neutral-900/30 text-purple-500 focus:ring-purple-500"
                        required
                    />
                    <label for="terms" class="ml-2 text-sm text-gray-400">
                        I agree with
                        <a
                            href="#"
                            class="text-purple-500 hover:text-purple-400"
                            >Terms of Use</a
                        >
                        and
                        <a
                            href="#"
                            class="text-purple-500 hover:text-purple-400"
                            >Privacy Policy</a
                        >
                    </label>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="rounded-lg bg-purple-600 px-6 py-3 font-medium text-white hover:bg-purple-700"
                    >
                        Send Your Message
                    </button>
                </div>
            </form>
        </div>
    </section>
</template>

<script setup lang="ts">
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import {
    LetsConnectFormInterface,
    LetsConnectOptionsInterface,
} from '@/Types/App/Interfaces';
import { InertiaForm, useForm } from '@inertiajs/vue3';

const form: InertiaForm<LetsConnectFormInterface> =
    useForm<LetsConnectFormInterface>({
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        inquiry_type: '',
        source: '',
        message: '',
        accept_terms: false,
    });

const inquiryTypes: LetsConnectOptionsInterface[] = [
    {
        id: 1,
        value: 'buy',
        label: 'Looking to Buy',
    },
    {
        id: 2,
        value: 'sell',
        label: 'Looking to Sell',
    },
    {
        id: 3,
        value: 'rent',
        label: 'Looking to Rent',
    },
    {
        id: 4,
        value: 'other',
        label: 'Other',
    },
];

const sources: LetsConnectOptionsInterface[] = [
    {
        id: 1,
        value: 'search',
        label: 'Search Engine',
    },
    {
        id: 2,
        value: 'social',
        label: 'Social Media',
    },
    {
        id: 3,
        value: 'referral',
        label: 'Referral',
    },
    {
        id: 4,
        value: 'other',
        label: 'Other',
    },
];
</script>
