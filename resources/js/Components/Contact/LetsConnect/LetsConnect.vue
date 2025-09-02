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

            <form @submit.prevent="submit()" class="w-full">
                <div class="mb-8 grid gap-6 md:grid-cols-2">
                    <div class="flex flex-col">
                        <TextInput
                            id="firstName"
                            label="First Name:"
                            v-model:modelValue="form.firstName"
                            type="text"
                            placeholder="Enter First Name"
                        />
                        <div v-if="form.errors.firstName">
                            {{ form.errors.firstName }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <TextInput
                            id="lastName"
                            label="Last Name:"
                            v-model:modelValue="form.lastName"
                            type="text"
                            placeholder="Enter Last Name"
                        />
                        <div v-if="form.errors.lastName">
                            {{ form.errors.lastName }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <TextInput
                            id="email"
                            label="Email:"
                            v-model:modelValue="form.email"
                            type="email"
                            placeholder="Enter Your E-mail"
                        />
                        <div v-if="form.errors.email">
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <TextInput
                            id="phone"
                            label="Phone:"
                            v-model:modelValue="form.phone"
                            type="tel"
                            placeholder="Enter Phone Number"
                        />
                        <div v-if="form.errors.phone">
                            {{ form.errors.phone }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <DropdownInput
                            id="inquiryType"
                            label="Inquiry Type:"
                            v-model:modelValue="form.inquiryType"
                            placeholder="Select Inquiry Type"
                            :options="inquiryTypes"
                        />
                        <div v-if="form.errors.inquiryType">
                            {{ form.errors.inquiryType }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <DropdownInput
                            id="source"
                            label="How Did You Hear About Us?:"
                            v-model:modelValue="form.source"
                            placeholder="Select"
                            :options="sources"
                        />
                        <div v-if="form.errors.source">
                            {{ form.errors.source }}
                        </div>
                    </div>
                </div>

                <div class="mb-6 flex flex-col">
                    <TextareaInput
                        id="message"
                        label="Message:"
                        v-model:modelValue="form.message"
                        :rows="6"
                        placeholder="Enter Your Message Here"
                    />
                    <div v-if="form.errors.message">
                        {{ form.errors.message }}
                    </div>
                </div>

                <div class="mb-8 flex items-start">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="terms"
                            v-model="form.termsAgreed"
                            class="mt-1 h-4 w-4 rounded border-neutral-800 bg-neutral-900/30 text-purple-500 focus:ring-purple-500"
                            required
                        />
                        <label for="terms" class="ml-2 text-sm text-gray-400">
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
                        class="rounded-lg bg-purple-600 px-6 py-3 font-medium text-white hover:bg-purple-700"
                        :disabled="!form.termsAgreed || form.processing"
                        :class="{
                            'cursor-not-allowed opacity-50':
                                !form.termsAgreed || form.processing,
                        }"
                    >
                        <span v-if="!form.processing">Send Your Message</span>
                        <span v-else>Sending...</span>
                    </button>
                    <p
                        v-if="showSuccessMessage"
                        class="mt-1 text-sm text-green-400"
                    >
                        {{ successMessage }}
                    </p>
                </div>
            </form>
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
import ContactController from '@/Routes/actions/App/Http/Controllers/ContactController';
import { InquiryTypeEnum } from '@/Types/App/Enums/InquiryTypeEnum';
import { SourceEnum } from '@/Types/App/Enums/SourceEnum';
import { LetsConnectFormInterface } from '@/Types/App/Interfaces/LetsConnectFormInterface';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { computed, ComputedRef, Ref, ref } from 'vue';

const successMessage: string =
    'Thank you for contacting us. We will get back to you as soon as possible.';

const showSuccessMessage: Ref<boolean> = ref<boolean>(false);
const showTermsOfUseModal: Ref<boolean> = ref<boolean>(false);
const showPrivacyPolicyModal: Ref<boolean> = ref<boolean>(false);

const openTermsOfUseModal = (): void => {
    showTermsOfUseModal.value = true;
};

const openPrivacyPolicyModal = (): void => {
    showPrivacyPolicyModal.value = true;
};

const form: InertiaForm<LetsConnectFormInterface> =
    useForm<LetsConnectFormInterface>({
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        inquiryType: InquiryTypeEnum.OTHER,
        source: SourceEnum.OTHER,
        message: '',
        termsAgreed: false,
    });

const inquiryTypes: ComputedRef<Record<string, string>> = computed(
    (): Record<string, string> =>
        Object.fromEntries(
            Object.values(InquiryTypeEnum).map(
                (inquiryType: InquiryTypeEnum): string[] => {
                    const label = capitalizeFirstLetter(inquiryType);
                    return [
                        inquiryType,
                        inquiryType === InquiryTypeEnum.OTHER
                            ? label
                            : `Looking For ${label}`,
                    ];
                },
            ),
        ),
);

const sources: ComputedRef<Record<string, string>> = computed(
    (): Record<string, string> =>
        Object.fromEntries(
            Object.values(SourceEnum).map((source: SourceEnum): string[] => [
                source,
                capitalizeFirstLetter(source),
            ]),
        ),
);

const submit = (): void => {
    showSuccessMessage.value = false;

    form.post(ContactController.store().url, {
        preserveScroll: true,
        onSuccess: (): void => {
            showSuccessMessage.value = true;
            form.reset();

            setTimeout((): void => {
                showSuccessMessage.value = false;
            }, 8000);
        },
    });
};
</script>
