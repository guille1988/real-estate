<template>
    <section class="w-full bg-black py-16 text-white" id="lets-connect">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="mb-4 text-3xl font-medium">Let's Connect</h2>
                <p class="w-full text-gray-400">
                    We're excited to connect with you and learn more about your
                    real estate goals. Use the form below to get in touch with
                    Real State.
                </p>
                <p class="w-full text-gray-400">
                    Whether you're a prospective client, partner, or simply
                    curious about our services, we're here to answer your
                    questions and provide the assistance you need.
                </p>
            </div>

            <form @submit.prevent="handleSubmit" class="w-full">
                <div class="mb-8 grid gap-6 md:grid-cols-2">
                    <div class="flex flex-col">
                        <label for="firstName" class="mb-3 text-sm text-white"
                            >First Name</label
                        >
                        <input
                            type="text"
                            id="firstName"
                            v-model="formData.firstName"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            placeholder="Enter First Name"
                            required
                        />
                    </div>

                    <div class="flex flex-col">
                        <label for="lastName" class="mb-3 text-sm text-white"
                            >Last Name</label
                        >
                        <input
                            type="text"
                            id="lastName"
                            v-model="formData.lastName"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            placeholder="Enter Last Name"
                            required
                        />
                    </div>

                    <div class="flex flex-col">
                        <label for="email" class="mb-3 text-sm text-white"
                            >Email</label
                        >
                        <input
                            type="email"
                            id="email"
                            v-model="formData.email"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            placeholder="Enter your Email"
                            required
                        />
                    </div>

                    <div class="flex flex-col">
                        <label for="phone" class="mb-3 text-sm text-white"
                            >Phone</label
                        >
                        <input
                            type="tel"
                            id="phone"
                            v-model="formData.phone"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                            placeholder="Enter Phone Number"
                            required
                        />
                    </div>

                    <div class="flex flex-col">
                        <label for="inquiryType" class="mb-3 text-sm text-white"
                            >Inquiry Type</label
                        >
                        <select
                            id="inquiryType"
                            v-model="formData.inquiryType"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white focus:border-purple-500 focus:outline-none"
                            required
                        >
                            <option value="" disabled selected>
                                Select Inquiry Type
                            </option>
                            <option value="buy">Looking to Buy</option>
                            <option value="sell">Looking to Sell</option>
                            <option value="rent">Looking to Rent</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="source" class="mb-3 text-sm text-white"
                            >How Did You Hear About Us?</label
                        >
                        <select
                            id="source"
                            v-model="formData.source"
                            class="rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white focus:border-purple-500 focus:outline-none"
                            required
                        >
                            <option value="" disabled selected>Select</option>
                            <option value="search">Search Engine</option>
                            <option value="social">Social Media</option>
                            <option value="referral">Referral</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6 flex flex-col">
                    <label for="message" class="mb-3 text-sm text-white"
                        >Message</label
                    >
                    <textarea
                        id="message"
                        v-model="formData.message"
                        rows="6"
                        class="w-full rounded-sm border border-neutral-800 bg-neutral-900/30 px-4 py-3 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none"
                        placeholder="Enter your Message here"
                        required
                    ></textarea>
                </div>

                <div class="mb-8 flex items-start">
                    <input
                        type="checkbox"
                        id="terms"
                        v-model="formData.acceptTerms"
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
import { ref } from 'vue';

interface FormData {
    firstName: string;
    lastName: string;
    email: string;
    phone: string;
    inquiryType: string;
    source: string;
    message: string;
    acceptTerms: boolean;
}

const formData = ref<FormData>({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    inquiryType: '',
    source: '',
    message: '',
    acceptTerms: false,
});

const handleSubmit = (): void => {
    console.log('Form submitted:', formData.value);
};
</script>
