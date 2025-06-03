<template>
    <div class="bg-black text-white">
        <div class="max-w-8xl mx-20">
            <div class="mb-10">
                <h1 class="mb-4 text-3xl font-bold md:text-4xl">
                    Let's Make it Happen
                </h1>
                <p class="max-w-2xl text-gray-400">
                    Ready to take the first step toward your dream property?
                    Fill out the form below, and our Real Estate wizards will
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
                        <TextInput
                            id="firstName"
                            label="First Name"
                            v-model="formData.firstName"
                            type="text"
                            placeholder="Enter First Name"
                        />
                        <TextInput
                            id="lastName"
                            label="Last Name"
                            v-model="formData.lastName"
                            type="text"
                            placeholder="Enter Last Name"
                        />
                        <TextInput
                            id="email"
                            label="Email"
                            v-model="formData.email"
                            type="email"
                            placeholder="Enter your Email"
                        />
                        <TextInput
                            id="phone"
                            label="Phone"
                            v-model="formData.phone"
                            type="tel"
                            placeholder="Enter Phone Number"
                        />
                    </div>

                    <div
                        class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                    >
                        <DropdownInput
                            id="location"
                            label="Preferred Location"
                            v-model="formData.location"
                            placeholder="Select Location"
                            :options="locations"
                        />
                        <DropdownInput
                            id="propertyType"
                            label="Property Type"
                            v-model="formData.propertyType"
                            placeholder="Select Property Type"
                            :options="propertyTypes"
                        />
                        <DropdownInput
                            id="bathrooms"
                            label="No. of Bathrooms"
                            v-model="formData.bathrooms"
                            placeholder="Select no. of bathrooms"
                            :options="[1, 2, 3, 4, 5]"
                        />
                        <DropdownInput
                            id="bedrooms"
                            label="No. of Bedrooms"
                            v-model="formData.bedrooms"
                            placeholder="Select no. of bedrooms"
                            :options="[1, 2, 3, 4, 5]"
                        />
                    </div>

                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                        <DropdownInput
                            id="budget"
                            label="Budget"
                            v-model="formData.budget"
                            placeholder="Select Budget"
                            :options="budgetRanges"
                        />
                    </div>

                    <div class="mb-6">
                        <TextareaInput
                            id="message"
                            label="Message"
                            v-model="formData.message"
                            :rows="5"
                            placeholder="Enter your Message here."
                        />
                    </div>

                    <div
                        class="flex flex-col justify-between md:flex-row md:items-center"
                    >
                        <div class="mb-4 md:mb-0">
                            <CheckboxInput
                                id="termsAgreed"
                                label="I agree with Terms of Use and Privacy Policy"
                                v-model="formData.termsAgreed"
                            />
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
import CheckboxInput from './Inputs/CheckboxInput.vue';
import DropdownInput from './Inputs/DropdownInput.vue';
import TextareaInput from './Inputs/TextareaInput.vue';
import TextInput from './Inputs/TextInput.vue';

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
};
</script>
