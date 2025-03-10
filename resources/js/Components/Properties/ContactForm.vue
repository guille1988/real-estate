<template>
    <div class="bg-black text-white">
        <div class="max-w-8xl mx-20">
            <div class="mb-10">
                <h1 class="mb-4 text-3xl font-bold md:text-4xl">
                    Let's Make it Happen
                </h1>
                <p class="max-w-2xl text-gray-400">
                    Ready to take the first step toward your dream property?
                    Fill out the form below, and our real estate wizards will
                    work their magic to find your perfect match. Don't wait,
                    let's embark on this exciting journey together.
                </p>
            </div>

            <div
                class="rounded-lg border border-gray-800 bg-black/50 p-6 md:p-10"
            >
                <form @submit.prevent="submitForm">
                    <div
                        class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                    >
                        <div>
                            <label for="firstName" class="mb-2 block text-sm"
                                >First Name</label
                            >
                            <input
                                id="firstName"
                                v-model="formData.firstName"
                                type="text"
                                placeholder="Enter First Name"
                                class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                            />
                        </div>
                        <div>
                            <label for="lastName" class="mb-2 block text-sm"
                                >Last Name</label
                            >
                            <input
                                id="lastName"
                                v-model="formData.lastName"
                                type="text"
                                placeholder="Enter Last Name"
                                class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                            />
                        </div>
                        <div>
                            <label for="email" class="mb-2 block text-sm"
                                >Email</label
                            >
                            <input
                                id="email"
                                v-model="formData.email"
                                type="email"
                                placeholder="Enter your Email"
                                class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                            />
                        </div>
                        <div>
                            <label for="phone" class="mb-2 block text-sm"
                                >Phone</label
                            >
                            <input
                                id="phone"
                                v-model="formData.phone"
                                type="tel"
                                placeholder="Enter Phone Number"
                                class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                            />
                        </div>
                    </div>

                    <div
                        class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                    >
                        <div>
                            <label for="location" class="mb-2 block text-sm"
                                >Preferred Location</label
                            >
                            <div class="relative">
                                <select
                                    id="location"
                                    v-model="formData.location"
                                    class="w-full appearance-none rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                                >
                                    <option value="" disabled selected>
                                        Select Location
                                    </option>
                                    <option
                                        v-for="location in locations"
                                        :key="location"
                                        :value="location"
                                    >
                                        {{ location }}
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2"
                                >
                                    <svg
                                        class="h-4 w-4 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="propertyType" class="mb-2 block text-sm"
                                >Property Type</label
                            >
                            <div class="relative">
                                <select
                                    id="propertyType"
                                    v-model="formData.propertyType"
                                    class="w-full appearance-none rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                                >
                                    <option value="" disabled selected>
                                        Select Property Type
                                    </option>
                                    <option
                                        v-for="type in propertyTypes"
                                        :key="type"
                                        :value="type"
                                    >
                                        {{ type }}
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2"
                                >
                                    <svg
                                        class="h-4 w-4 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="bathrooms" class="mb-2 block text-sm"
                                >No. of Bathrooms</label
                            >
                            <div class="relative">
                                <select
                                    id="bathrooms"
                                    v-model="formData.bathrooms"
                                    class="w-full appearance-none rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                                >
                                    <option value="" disabled selected>
                                        Select no. of bathrooms
                                    </option>
                                    <option
                                        v-for="num in 5"
                                        :key="`bath-${num}`"
                                        :value="num"
                                    >
                                        {{ num }}
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2"
                                >
                                    <svg
                                        class="h-4 w-4 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="bedrooms" class="mb-2 block text-sm"
                                >No. of Bedrooms</label
                            >
                            <div class="relative">
                                <select
                                    id="bedrooms"
                                    v-model="formData.bedrooms"
                                    class="w-full appearance-none rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                                >
                                    <option value="" disabled selected>
                                        Select no. of bedrooms
                                    </option>
                                    <option
                                        v-for="num in 5"
                                        :key="`bed-${num}`"
                                        :value="num"
                                    >
                                        {{ num }}
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2"
                                >
                                    <svg
                                        class="h-4 w-4 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="budget" class="mb-2 block text-sm"
                                >Budget</label
                            >
                            <div class="relative">
                                <select
                                    id="budget"
                                    v-model="formData.budget"
                                    class="w-full appearance-none rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                                >
                                    <option value="" disabled selected>
                                        Select Budget
                                    </option>
                                    <option
                                        v-for="budget in budgetRanges"
                                        :key="budget"
                                        :value="budget"
                                    >
                                        {{ budget }}
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2"
                                >
                                    <svg
                                        class="h-4 w-4 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm"
                                >Preferred Contact Method</label
                            >
                            <div class="flex space-x-6">
                                <div class="flex items-center space-x-2">
                                    <input
                                        id="contactPhone"
                                        v-model="formData.contactMethod"
                                        type="radio"
                                        value="phone"
                                        class="h-4 w-4 accent-purple-600"
                                    />
                                    <label
                                        for="contactPhone"
                                        class="flex items-center text-sm"
                                    >
                                        <svg
                                            class="mr-2 h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                            ></path>
                                        </svg>
                                        Enter Your Number
                                    </label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input
                                        id="contactEmail"
                                        v-model="formData.contactMethod"
                                        type="radio"
                                        value="email"
                                        class="h-4 w-4 accent-purple-600"
                                    />
                                    <label
                                        for="contactEmail"
                                        class="flex items-center text-sm"
                                    >
                                        <svg
                                            class="mr-2 h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                            ></path>
                                        </svg>
                                        Enter Your Email
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="message" class="mb-2 block text-sm"
                            >Message</label
                        >
                        <textarea
                            id="message"
                            v-model="formData.message"
                            rows="5"
                            placeholder="Enter your Message here."
                            class="w-full rounded border border-gray-700 bg-black/70 p-3 text-sm focus:border-purple-500 focus:outline-none"
                        ></textarea>
                    </div>

                    <div
                        class="flex flex-col justify-between md:flex-row md:items-center"
                    >
                        <div class="mb-4 md:mb-0">
                            <label class="flex items-center">
                                <input
                                    type="checkbox"
                                    v-model="formData.termsAgreed"
                                    class="mr-2 h-4 w-4 accent-purple-600"
                                />
                                <span class="text-sm text-gray-400"
                                    >I agree with Terms of Use and Privacy
                                    Policy</span
                                >
                            </label>
                        </div>
                        <button
                            type="submit"
                            class="rounded bg-purple-600 px-6 py-3 text-white transition duration-300 hover:bg-purple-700"
                            :disabled="!formData.termsAgreed"
                            :class="{
                                'cursor-not-allowed opacity-50':
                                    !formData.termsAgreed,
                            }"
                        >
                            Send Your Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const formData = ref({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    location: '',
    propertyType: '',
    bathrooms: '',
    bedrooms: '',
    budget: '',
    contactMethod: 'phone',
    message: '',
    termsAgreed: false,
});

const locations = [
    'New York',
    'Los Angeles',
    'Chicago',
    'Miami',
    'San Francisco',
    'Seattle',
    'Austin',
    'Denver',
];

const propertyTypes = [
    'Apartment',
    'House',
    'Condo',
    'Townhouse',
    'Villa',
    'Land',
];

const budgetRanges = [
    'Under $100,000',
    '$100,000 - $250,000',
    '$250,000 - $500,000',
    '$500,000 - $750,000',
    '$750,000 - $1,000,000',
    'Over $1,000,000',
];

const submitForm = (): void => {
    if (!formData.value.termsAgreed) {
        alert('Please agree to the Terms of Use and Privacy Policy');
        return;
    }

    console.log('Form submitted:', formData.value);
    alert('Form submitted successfully!');

    formData.value = {
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        location: '',
        propertyType: '',
        bathrooms: '',
        bedrooms: '',
        budget: '',
        contactMethod: 'phone',
        message: '',
        termsAgreed: false,
    };
};
</script>
