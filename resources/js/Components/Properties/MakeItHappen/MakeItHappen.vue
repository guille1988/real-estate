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
                    <form @submit.prevent="submit()">
                        <div
                            class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                        >
                            <div class="flex flex-col">
                                <TextInput
                                    id="firstName"
                                    label="First Name"
                                    v-model:modelValue="form.firstName"
                                    type="text"
                                    placeholder="Enter First Name"
                                />
                                <div
                                    v-if="form.errors.firstName"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.firstName }}
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <TextInput
                                    id="lastName"
                                    label="Last Name"
                                    v-model:modelValue="form.lastName"
                                    type="text"
                                    placeholder="Enter Last Name"
                                />
                                <div
                                    v-if="form.errors.lastName"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.lastName }}
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <TextInput
                                    id="email"
                                    label="Email"
                                    v-model:modelValue="form.email"
                                    type="email"
                                    placeholder="Enter your Email"
                                />
                                <div
                                    v-if="form.errors.email"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.email }}
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <TextInput
                                    id="phone"
                                    label="Phone"
                                    v-model:modelValue="form.phone"
                                    type="tel"
                                    placeholder="Enter Phone Number"
                                />
                                <div
                                    v-if="form.errors.phone"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.phone }}
                                </div>
                            </div>
                        </div>

                        <div
                            class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                        >
                            <div class="flex flex-col">
                                <DropdownInput
                                    id="location"
                                    label="Preferred Location"
                                    v-model:modelValue="form.location"
                                    placeholder="Select Location"
                                    :options="locations"
                                />
                                <div
                                    v-if="form.errors.location"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.location }}
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <DropdownInput
                                    id="propertyType"
                                    label="Property Type"
                                    v-model:modelValue="form.propertyType"
                                    placeholder="Select Property Type"
                                    :options="types"
                                />
                                <div
                                    v-if="form.errors.propertyType"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.propertyType }}
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <DropdownInput
                                    id="bathroomCount"
                                    label="No. of Bathrooms"
                                    v-model:modelValue="form.bathrooms"
                                    placeholder="Select no. of bathrooms"
                                    :options="bathrooms"
                                />
                                <div
                                    v-if="form.errors.bathrooms"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.bathrooms }}
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <DropdownInput
                                    id="bedroomCount"
                                    label="No. of Bedrooms"
                                    v-model:modelValue="form.bedrooms"
                                    placeholder="Select no. of bedrooms"
                                    :options="bedrooms"
                                />
                                <div
                                    v-if="form.errors.bedrooms"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.bedrooms }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="flex flex-col">
                                <DropdownInput
                                    id="budget"
                                    label="Budget"
                                    v-model:modelValue="form.budget"
                                    placeholder="Select Budget"
                                    :options="budgets"
                                />
                                <div
                                    v-if="form.errors.budget"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.budget }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex flex-col">
                                <TextAreaInput
                                    id="message"
                                    label="Message"
                                    v-model:modelValue="form.message"
                                    :rows="5"
                                    placeholder="Enter your Message here."
                                />
                                <div
                                    v-if="form.errors.message"
                                    class="mt-1 text-sm text-red-500 dark:text-red-400"
                                >
                                    {{ form.errors.message }}
                                </div>
                            </div>
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
                            <div class="flex flex-col items-end gap-2">
                                <button
                                    type="submit"
                                    class="rounded bg-purple-600 px-6 py-3 text-white transition duration-300 hover:bg-purple-700"
                                    :disabled="
                                        !form.termsAgreed || form.processing
                                    "
                                    :class="{
                                        'cursor-not-allowed opacity-50':
                                            !form.termsAgreed ||
                                            form.processing,
                                    }"
                                >
                                    <span v-if="!form.processing"
                                        >Send Your Message</span
                                    >
                                    <span v-else>Sending...</span>
                                </button>
                            </div>
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
import TextAreaInput from '@/Components/Shared/Inputs/TextAreaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import PrivacyPolicyModal from '@/Components/Shared/Modals/PrivacyPolicyModal/PrivacyPolicyModal.vue';
import TermsOfUseModal from '@/Components/Shared/Modals/TermsOfUseModal/TermsOfUseModal.vue';
import PropertyMessageController from '@/Routes/actions/App/Http/Controllers/PropertyMessageController';
import { MakeItHappenFormInterface } from '@/Types/App/Interfaces/MakeItHappenFormInterface';
import { PropertyBathroomInterface } from '@/Types/App/Interfaces/PropertyBathroomInterface';
import { PropertyBedroomInterface } from '@/Types/App/Interfaces/PropertyBedroomInterface';
import { PropertyBudgetInterface } from '@/Types/App/Interfaces/PropertyBudgetInterface';
import { PropertyLocationInterface } from '@/Types/App/Interfaces/PropertyLocationInterface';
import { PropertyTypeInterface } from '@/Types/App/Interfaces/PropertyTypeInterface';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { type Ref, ref } from 'vue';
import { toast } from 'vue3-toastify';

const {
    locations,
    types,
    budgets,
}: {
    locations: PropertyLocationInterface[];
    types: PropertyTypeInterface[];
    budgets: PropertyBudgetInterface[];
} = defineProps<{
    locations: PropertyLocationInterface[];
    types: PropertyTypeInterface[];
    budgets: PropertyBudgetInterface[];
    bathrooms: PropertyBathroomInterface[];
    bedrooms: PropertyBedroomInterface[];
}>();

const successMessage: string =
    'Thank you for contacting us. We will get back to you as soon as possible.';
const showTermsOfUseModal: Ref<boolean> = ref<boolean>(false);
const showPrivacyPolicyModal: Ref<boolean> = ref<boolean>(false);

const form: InertiaForm<MakeItHappenFormInterface> =
    useForm<MakeItHappenFormInterface>({
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        location: null,
        propertyType: null,
        bathrooms: null,
        bedrooms: null,
        budget: '',
        message: '',
        termsAgreed: false,
    });

const openTermsOfUseModal = (): void => {
    showTermsOfUseModal.value = true;
};

const openPrivacyPolicyModal = (): void => {
    showPrivacyPolicyModal.value = true;
};

const submit = (): void => {
    if (!form.termsAgreed) {
        return;
    }

    form.post(PropertyMessageController().url, {
        preserveScroll: true,
        onSuccess: (): void => {
            form.reset();
            toast.success(successMessage);
        },
        onError: (): void => {
            setTimeout((): void => {
                form.clearErrors();
            }, 4000);
        },
    });
};
</script>
