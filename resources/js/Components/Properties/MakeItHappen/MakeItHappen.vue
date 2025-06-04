<template>
    <div class="bg-black text-white">
        <div class="container mx-auto px-4">
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
                            id="first_name"
                            label="First Name"
                            v-model:model_value="formData.first_name"
                            type="text"
                            placeholder="Enter First Name"
                        />
                        <TextInput
                            id="last_name"
                            label="Last Name"
                            v-model:model_value="formData.last_name"
                            type="text"
                            placeholder="Enter Last Name"
                        />
                        <TextInput
                            id="email"
                            label="Email"
                            v-model:model_value="formData.email"
                            type="email"
                            placeholder="Enter your Email"
                        />
                        <TextInput
                            id="phone"
                            label="Phone"
                            v-model:model_value="formData.phone"
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
                            v-model:model_value="formData.location"
                            placeholder="Select Location"
                            :options_type="DropdownInputOptionsTypeEnum.ARRAY"
                            :options="locations"
                        />
                        <DropdownInput
                            id="property_type"
                            label="Property Type"
                            v-model:model_value="formData.property_type"
                            placeholder="Select Property Type"
                            :options_type="DropdownInputOptionsTypeEnum.ENUM"
                            :options="propertyTypes"
                        />
                        <DropdownInput
                            id="bathroom_count"
                            label="No. of Bathrooms"
                            v-model:model_value="formData.bathroom_count"
                            placeholder="Select no. of bathrooms"
                            :options_type="DropdownInputOptionsTypeEnum.ARRAY"
                            :options="[1, 2, 3, 4, 5]"
                        />
                        <DropdownInput
                            id="bedroom_count"
                            label="No. of Bedrooms"
                            v-model:model_value="formData.bedroom_count"
                            placeholder="Select no. of bedrooms"
                            :options_type="DropdownInputOptionsTypeEnum.ARRAY"
                            :options="[1, 2, 3, 4, 5]"
                        />
                    </div>

                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                        <DropdownInput
                            id="budget"
                            label="Budget"
                            v-model:model_value="formData.budget"
                            placeholder="Select Budget"
                            :options_type="DropdownInputOptionsTypeEnum.ARRAY"
                            :options="budgetRanges"
                        />
                    </div>

                    <div class="mb-6">
                        <TextareaInput
                            id="message"
                            label="Message"
                            v-model:model_value="formData.message"
                            :rows="5"
                            placeholder="Enter your Message here."
                        />
                    </div>

                    <div
                        class="flex flex-col justify-between md:flex-row md:items-center"
                    >
                        <div class="mb-4 md:mb-0">
                            <CheckboxInput
                                id="terms_agreed"
                                label="I agree with Terms of Use and Privacy Policy"
                                v-model:model_value="formData.terms_agreed"
                            />
                        </div>
                        <button
                            type="submit"
                            class="rounded bg-purple-600 px-6 py-3 text-white transition duration-300 hover:bg-purple-700"
                            :disabled="!formData.terms_agreed"
                            :class="{
                                'cursor-not-allowed opacity-50':
                                    !formData.terms_agreed,
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
import {
    DropdownInputOptionsTypeEnum,
    PropertyTypeEnum,
} from '@/Types/App/Enums';
import { MakeItHappenFormInterface } from '@/Types/App/Interfaces';
import { ref } from 'vue';
import CheckboxInput from './Inputs/CheckboxInput.vue';
import DropdownInput from './Inputs/DropdownInput.vue';
import TextareaInput from './Inputs/TextareaInput.vue';
import TextInput from './Inputs/TextInput.vue';

const formData = ref<MakeItHappenFormInterface>({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    location: '',
    property_type: null,
    bathroom_count: null,
    bedroom_count: null,
    budget: '',
    message: '',
    terms_agreed: false,
});

const locations: string[] = [
    'New York',
    'Los Angeles',
    'Chicago',
    'Miami',
    'San Francisco',
    'Seattle',
    'Austin',
    'Denver',
];

const budgetRanges: string[] = [
    'Under $100,000',
    '$100,000 - $250,000',
    '$250,000 - $500,000',
    '$500,000 - $750,000',
    '$750,000 - $1,000,000',
    'Over $1,000,000',
];

const propertyTypes: string[] = Object.values(PropertyTypeEnum);

const submitForm = (): void => {
    if (!formData.value.terms_agreed) {
        alert('Please agree to the Terms of Use and Privacy Policy');
        return;
    }

    console.log(formData.value);
};
</script>
