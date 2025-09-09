<template>
    <section class="w-full bg-black py-8 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <WhenVisible :data="['title']">
                <template #fallback>
                    <div
                        class="grid animate-pulse grid-cols-1 gap-8 md:grid-cols-3"
                    >
                        <div class="md:col-span-1">
                            <div
                                class="mb-4 h-6 w-24 rounded bg-gray-700/50"
                            ></div>
                            <div
                                class="mb-4 h-8 w-64 rounded bg-gray-700/50"
                            ></div>
                            <div
                                class="mb-2 h-8 w-40 rounded bg-gray-700/50"
                            ></div>
                            <div
                                class="h-20 w-full rounded bg-gray-700/30"
                            ></div>
                        </div>
                        <div class="md:col-span-2">
                            <div
                                class="rounded-lg border border-gray-800 bg-black p-6 shadow-lg"
                            >
                                <div
                                    class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div
                                        class="h-10 w-full rounded bg-gray-700/30"
                                    ></div>
                                    <div
                                        class="h-10 w-full rounded bg-gray-700/30"
                                    ></div>
                                </div>
                                <div
                                    class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div
                                        class="h-10 w-full rounded bg-gray-700/30"
                                    ></div>
                                    <div
                                        class="h-10 w-full rounded bg-gray-700/30"
                                    ></div>
                                </div>
                                <div class="mb-6">
                                    <div
                                        class="h-24 w-full rounded bg-gray-700/30"
                                    ></div>
                                </div>
                                <div class="mb-6 flex items-center gap-2">
                                    <div
                                        class="h-5 w-5 rounded bg-gray-700/40"
                                    ></div>
                                    <div
                                        class="h-4 w-28 rounded bg-gray-700/50"
                                    ></div>
                                    <div
                                        class="h-4 w-20 rounded bg-gray-700/50"
                                    ></div>
                                    <div
                                        class="h-4 w-24 rounded bg-gray-700/50"
                                    ></div>
                                </div>
                                <div class="flex justify-end">
                                    <div
                                        class="h-10 w-40 rounded bg-gray-700/40"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="md:col-span-1">
                        <ThreeStars />
                        <h2 class="mb-4 text-3xl font-medium">
                            Inquire About <br />
                            {{ title }}
                        </h2>
                        <p class="text-gray-400">
                            Interested in this property? Fill out the form
                            below, and our real estate experts will get back to
                            you with more details, including scheduling a
                            viewing and answering any questions you may have.
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <form
                            @submit.prevent="submit()"
                            class="rounded-lg border border-gray-800 bg-black p-6 shadow-lg"
                        >
                            <div
                                class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2"
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
                            </div>

                            <div
                                class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2"
                            >
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
                            <div class="mb-6">
                                <div class="flex flex-col">
                                    <TextareaInput
                                        id="message"
                                        label="Message"
                                        v-model:modelValue="form.message"
                                        :rows="4"
                                        placeholder="Enter your Message here"
                                    />
                                    <div
                                        v-if="form.errors.message"
                                        class="mt-1 text-sm text-red-500 dark:text-red-400"
                                    >
                                        {{ form.errors.message }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center">
                                    <CheckboxInput
                                        id="termsAgreed"
                                        label="I agree with "
                                        v-model:modelValue="form.termsAgreed"
                                        text-class="text-gray-400"
                                    />
                                    <button
                                        type="button"
                                        class="ml-1 text-purple-500 hover:text-purple-400"
                                        @click="openTermsOfUseModal()"
                                    >
                                        Terms of Use
                                    </button>
                                    <span class="mx-1 text-gray-400">and</span>
                                    <button
                                        type="button"
                                        class="text-purple-500 hover:text-purple-400"
                                        @click="openPrivacyPolicyModal()"
                                    >
                                        Privacy Policy
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col items-end gap-2">
                                <button
                                    type="submit"
                                    class="rounded-lg bg-purple-600 px-6 py-3 text-white transition-colors duration-200 hover:bg-purple-700"
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
                                <p
                                    v-if="showSuccessMessage"
                                    class="mt-1 text-sm text-green-400"
                                >
                                    {{ successMessage }}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </WhenVisible>
        </div>
    </section>

    <TermsOfUseModal v-model="showTermsOfUseModal" />
    <PrivacyPolicyModal v-model="showPrivacyPolicyModal" />
</template>

<script setup lang="ts">
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import CheckboxInput from '@/Components/Shared/Inputs/CheckboxInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import TextareaInput from '@/Components/Shared/Inputs/TextareaInput.vue';
import PrivacyPolicyModal from '@/Components/Shared/Modals/PrivacyPolicyModal/PrivacyPolicyModal.vue';
import TermsOfUseModal from '@/Components/Shared/Modals/TermsOfUseModal/TermsOfUseModal.vue';
import PropertyController from '@/Routes/actions/App/Http/Controllers/PropertyController';
import { InquireFormInterface } from '@/Types/App/Interfaces/InquireFormInterface';
import { InertiaForm, useForm, WhenVisible } from '@inertiajs/vue3';
import { ref, type Ref } from 'vue';

const { propertyUuid }: { propertyUuid: string } = defineProps<{
    propertyUuid: string;
    title: string;
}>();

const successMessage: string =
    'Thank you for contacting us. We will get back to you as soon as possible.';
const showSuccessMessage: Ref<boolean> = ref<boolean>(false);
const showTermsOfUseModal: Ref<boolean> = ref<boolean>(false);
const showPrivacyPolicyModal: Ref<boolean> = ref<boolean>(false);

const form: InertiaForm<InquireFormInterface> = useForm<InquireFormInterface>({
    propertyUuid: propertyUuid,
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
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
    showSuccessMessage.value = false;

    if (!form.termsAgreed) {
        return;
    }

    form.post(PropertyController.inquire().url, {
        preserveScroll: true,
        onSuccess: (): void => {
            showSuccessMessage.value = true;
            form.reset();

            setTimeout((): void => {
                showSuccessMessage.value = false;
            }, 4000);
        },
        onError: (): void => {
            setTimeout((): void => {
                form.clearErrors();
            }, 4000);
        },
    });
};
</script>
