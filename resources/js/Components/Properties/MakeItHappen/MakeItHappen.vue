<template>
    <section id="make-it-happen">
        <div class="bg-black text-white">
            <div class="container mx-auto px-4">
                <div class="mb-10">
                    <ThreeStars />
                    <h1 class="mb-4 text-2xl font-bold md:text-3xl">
                        Let's Make it Happen
                    </h1>
                    <p class="max-w-2xl text-gray-400">
                        Ready to take the first step toward your dream property?
                        Fill out the form below, and our Real Estate wizards
                        will work their magic to find your perfect match. Don't
                        wait, let's embark on this exciting journey together.
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
                                id="firstName"
                                label="First Name"
                                v-model:modelValue="form.firstName"
                                type="text"
                                placeholder="Enter First Name"
                            />
                            <TextInput
                                id="lastName"
                                label="Last Name"
                                v-model:modelValue="form.lastName"
                                type="text"
                                placeholder="Enter Last Name"
                            />
                            <TextInput
                                id="email"
                                label="Email"
                                v-model:modelValue="form.email"
                                type="email"
                                placeholder="Enter your Email"
                            />
                            <TextInput
                                id="phone"
                                label="Phone"
                                v-model:modelValue="form.phone"
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
                                v-model:modelValue="form.location"
                                placeholder="Select Location"
                                :options="locations"
                            />
                            <DropdownInput
                                id="propertyType"
                                label="Property Type"
                                v-model:modelValue="form.propertyType"
                                placeholder="Select Property Type"
                                :options="propertyTypes"
                            />
                            <DropdownInput
                                id="bathroomCount"
                                label="No. of Bathrooms"
                                v-model:modelValue="form.bathrooms"
                                placeholder="Select no. of bathrooms"
                                :options="bathroomCountOptions"
                            />
                            <DropdownInput
                                id="bedroomCount"
                                label="No. of Bedrooms"
                                v-model:modelValue="form.bedrooms"
                                placeholder="Select no. of bedrooms"
                                :options="bedroomCountOptions"
                            />
                        </div>

                        <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                            <DropdownInput
                                id="budget"
                                label="Budget"
                                v-model:modelValue="form.budget"
                                placeholder="Select Budget"
                                :options="budgetRanges"
                            />
                        </div>

                        <div class="mb-6">
                            <TextareaInput
                                id="message"
                                label="Message"
                                v-model:modelValue="form.message"
                                :rows="5"
                                placeholder="Enter your Message here."
                            />
                        </div>

                        <div
                            class="flex flex-col justify-between md:flex-row md:items-center"
                        >
                            <div class="mb-4 md:mb-0">
                                <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        id="terms"
                                        v-model="form.termsAgreed"
                                        class="mt-1 h-4 w-4 rounded border-neutral-800 bg-neutral-900/30 text-purple-500 focus:ring-purple-500"
                                        required
                                    />
                                    <label
                                        for="terms"
                                        class="ml-2 text-sm text-gray-400"
                                    >
                                        I agree with
                                        <button
                                            type="button"
                                            class="text-purple-500 hover:text-purple-400"
                                            @click="openTermsOfUseModal()"
                                        >
                                            Terms of Use
                                        </button>
                                        and
                                        <button
                                            type="button"
                                            class="text-purple-500 hover:text-purple-400"
                                            @click="openPrivacyPolicyModal()"
                                        >
                                            Privacy Policy
                                        </button>
                                    </label>
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="rounded bg-purple-600 px-6 py-3 text-white transition duration-300 hover:bg-purple-700"
                                :disabled="!form.termsAgreed"
                                :class="{
                                    'cursor-not-allowed opacity-50':
                                        !form.termsAgreed,
                                }"
                            >
                                Send Your Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <TermsOfUseModal v-model="showTermsOfUseModal" />
    <PrivacyPolicyModal v-model="showPrivacyPolicyModal" />
</template>

<script setup lang="ts">
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import DropdownInput from '@/Components/Shared/Inputs/DropdownInput.vue';
import TextareaInput from '@/Components/Shared/Inputs/TextareaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import PrivacyPolicyModal from '@/Components/Shared/Modals/PrivacyPolicyModal/PrivacyPolicyModal.vue';
import TermsOfUseModal from '@/Components/Shared/Modals/TermsOfUseModal/TermsOfUseModal.vue';
import { capitalizeFirstLetter } from '@/Composables/useCapitalization';
import { PropertyTypeEnum } from '@/Types/App/Enums/PropertyTypeEnum';
import { MakeItHappenFormInterface } from '@/Types/App/Interfaces/MakeItHappenFormInterface';
import { type Ref, ref } from 'vue';

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

const form: Ref<MakeItHappenFormInterface> = ref<MakeItHappenFormInterface>({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    location: '',
    propertyType: null,
    bathrooms: null,
    bedrooms: null,
    budget: '',
    message: '',
    termsAgreed: false,
});

const showTermsOfUseModal: Ref<boolean> = ref<boolean>(false);
const showPrivacyPolicyModal: Ref<boolean> = ref<boolean>(false);

const openTermsOfUseModal = (): void => {
    showTermsOfUseModal.value = true;
};

const openPrivacyPolicyModal = (): void => {
    showPrivacyPolicyModal.value = true;
};

const propertyTypes: Record<string, string> = Object.values(
    PropertyTypeEnum,
).reduce(
    (
        accumulator: Record<string, string>,
        propertyType: PropertyTypeEnum,
    ): Record<string, string> => {
        accumulator[propertyType] = capitalizeFirstLetter(propertyType);
        return accumulator;
    },
    {} as Record<string, string>,
);

const generateRoomCount = (max: number): Record<number, string> =>
    Array.from({ length: max }, (_, key: number) => key + 1).reduce<
        Record<number, string>
    >(
        (
            accumulator: Record<number, string>,
            key: number,
        ): Record<number, string> => {
            accumulator[key] = key.toString();
            return accumulator;
        },
        {},
    );

const bathroomCountOptions = generateRoomCount(5);
const bedroomCountOptions = generateRoomCount(5);

const submit = (): void => {
    if (!form.value.termsAgreed) {
        alert('Please agree to the Terms of Use and Privacy Policy');
        return;
    }

    console.log(form.value);
};
</script>
