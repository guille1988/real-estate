<template>
    <section class="w-full bg-black py-8 text-white">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="md:col-span-1">
                    <ThreeStars />
                    <h2 class="mb-4 text-3xl font-medium">
                        Inquire About Seaside<br />Serenity Villa
                    </h2>
                    <p class="text-gray-400">
                        Interested in this property? Fill out the form below,
                        and our real estate experts will get back to you with
                        more details, including scheduling a viewing and
                        answering any questions you may have.
                    </p>
                </div>

                <div class="md:col-span-2">
                    <form
                        @submit.prevent="submit"
                        class="rounded-lg border border-gray-800 bg-black p-6 shadow-lg"
                    >
                        <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
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
                        </div>

                        <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
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
                        <div class="mb-6">
                            <TextareaInput
                                id="message"
                                label="Message"
                                v-model:model_value="form.message"
                                :rows="4"
                                placeholder="Enter your Message here"
                            />
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center">
                                <CheckboxInput
                                    id="terms_agreed"
                                    label="I agree with "
                                    v-model:model_value="form.terms_agreed"
                                    text_class="text-gray-400"
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

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="rounded-lg bg-purple-600 px-6 py-3 text-white transition-colors duration-200 hover:bg-purple-700"
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
import { InquireFormInterface } from '@/Types/App/Interfaces/InquireFormInterface';
import { usePage } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';

const showTermsOfUseModal: Ref<boolean> = ref<boolean>(false);
const showPrivacyPolicyModal: Ref<boolean> = ref<boolean>(false);

const openTermsOfUseModal = (): void => {
    showTermsOfUseModal.value = true;
};

const openPrivacyPolicyModal = (): void => {
    showPrivacyPolicyModal.value = true;
};
const uuid: string = (usePage().props.id as string) || '';
const form: Ref<InquireFormInterface> = ref<InquireFormInterface>({
    uuid: uuid,
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    message: '',
    terms_agreed: false,
});

const submit = (): void => {
    if (!form.value.terms_agreed) {
        alert('Please agree to the Terms of Use and Privacy Policy');
        return;
    }

    console.log(form.value);
};
</script>
