<template>
    <div class="bg-black text-white">
        <div class="container mx-auto px-4">
            <div class="mb-10">
                <ThreeStars />
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
                <form @submit.prevent="submit">
                    <div
                        class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                    >
                        <TextInput
                            id="first_name"
                            label="First Name"
                            v-model:model_value="form.first_name"
                            type="text"
                            placeholder="Enter First Name"
                        />
                        <TextInput
                            id="last_name"
                            label="Last Name"
                            v-model:model_value="form.last_name"
                            type="text"
                            placeholder="Enter Last Name"
                        />
                        <TextInput
                            id="email"
                            label="Email"
                            v-model:model_value="form.email"
                            type="email"
                            placeholder="Enter your Email"
                        />
                        <TextInput
                            id="phone"
                            label="Phone"
                            v-model:model_value="form.phone"
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
                            v-model:model_value="form.location"
                            placeholder="Select Location"
                            :options="locations"
                        />
                        <DropdownInput
                            id="property_type"
                            label="Property Type"
                            v-model:model_value="form.property_type"
                            placeholder="Select Property Type"
                            :options="propertyTypes"
                        />
                        <DropdownInput
                            id="bathroom_count"
                            label="No. of Bathrooms"
                            v-model:model_value="form.bathroom_count"
                            placeholder="Select no. of bathrooms"
                            :options="bathroomCountOptions"
                        />
                        <DropdownInput
                            id="bedroom_count"
                            label="No. of Bedrooms"
                            v-model:model_value="form.bedroom_count"
                            placeholder="Select no. of bedrooms"
                            :options="bedroomCountOptions"
                        />
                    </div>

                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                        <DropdownInput
                            id="budget"
                            label="Budget"
                            v-model:model_value="form.budget"
                            placeholder="Select Budget"
                            :options="budgetRanges"
                        />
                    </div>

                    <div class="mb-6">
                        <TextareaInput
                            id="message"
                            label="Message"
                            v-model:model_value="form.message"
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
                                v-model:model_value="form.terms_agreed"
                            />
                        </div>
                        <button
                            type="submit"
                            class="rounded bg-purple-600 px-6 py-3 text-white transition duration-300 hover:bg-purple-700"
                            :disabled="!form.terms_agreed"
                            :class="{
                                'cursor-not-allowed opacity-50':
                                    !form.terms_agreed,
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
import CheckboxInput from '@/Components/Shared/Inputs/CheckboxInput.vue';
import DropdownInput from '@/Components/Shared/Inputs/DropdownInput.vue';
import TextareaInput from '@/Components/Shared/Inputs/TextareaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import ThreeStars from '@/Components/Shared/ThreeStars/ThreeStars.vue';
import { PropertyTypeEnum } from '@/Types/App/Enums';
import { MakeItHappenFormInterface } from '@/Types/App/Interfaces';
import { type Ref, ref } from 'vue';

const form: Ref<MakeItHappenFormInterface> = ref<MakeItHappenFormInterface>({
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

const locations: Record<string, string> = {
    '0': 'New York',
    '1': 'Los Angeles',
    '2': 'Chicago',
    '3': 'Miami',
    '4': 'San Francisco',
    '5': 'Seattle',
    '6': 'Austin',
    '7': 'Denver',
};

const budgetRanges: Record<string, string> = {
    '0': 'Under $100,000',
    '1': '$100,000 - $250,000',
    '2': '$250,000 - $500,000',
    '3': '$500,000 - $750,000',
    '4': '$750,000 - $1,000,000',
    '5': 'Over $1,000,000',
};

const capitalizeFirstLetter = (word: string): string =>
    word.charAt(0).toUpperCase() + word.slice(1);

const propertyTypes: Record<string, string> = Object.values(
    PropertyTypeEnum,
).reduce(
    (accumulator: Record<string, string>, propertyType: PropertyTypeEnum) => {
        accumulator[propertyType] = capitalizeFirstLetter(propertyType);
        return accumulator;
    },
    {} as Record<string, string>,
);

const generateRoomCount = (max: number): Record<number, string> =>
    Array.from({ length: max }, (_, key: number) => key + 1).reduce<
        Record<number, string>
    >((accumulator: Record<number, string>, key: number) => {
        accumulator[key] = key.toString();
        return accumulator;
    }, {});

const bathroomCountOptions = generateRoomCount(5);
const bedroomCountOptions = generateRoomCount(5);

const submit = (): void => {
    if (!form.value.terms_agreed) {
        alert('Please agree to the Terms of Use and Privacy Policy');
        return;
    }

    console.log(form.value);
};
</script>
