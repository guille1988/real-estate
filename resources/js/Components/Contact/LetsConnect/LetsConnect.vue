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

            <form @submit.prevent="form.post('/')" class="w-full">
                <div class="mb-8 grid gap-6 md:grid-cols-2">
                    <div class="flex flex-col">
                        <TextInput
                            id="first_name"
                            label="First Name:"
                            v-model:model_value="form.first_name"
                            type="text"
                            placeholder="Enter First Name"
                        />
                        <div v-if="form.errors.first_name">
                            {{ form.errors.first_name }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <TextInput
                            id="last_name"
                            label="Last Name:"
                            v-model:model_value="form.last_name"
                            type="text"
                            placeholder="Enter Last Name"
                        />
                        <div v-if="form.errors.last_name">
                            {{ form.errors.last_name }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <TextInput
                            id="email"
                            label="Email:"
                            v-model:model_value="form.email"
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
                            v-model:model_value="form.phone"
                            type="tel"
                            placeholder="Enter Phone Number"
                        />
                        <div v-if="form.errors.phone">
                            {{ form.errors.phone }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <DropdownInput
                            id="inquiry_type"
                            label="Inquiry Type:"
                            v-model:model_value="form.inquiry_type"
                            placeholder="Select Inquiry Type"
                            :options="inquiryTypes"
                        />
                        <div v-if="form.errors.inquiry_type">
                            {{ form.errors.inquiry_type }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <DropdownInput
                            id="source"
                            label="How Did You Hear About Us?:"
                            v-model:model_value="form.source"
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
                        v-model:model_value="form.message"
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
                            v-model="form.terms_agreed"
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
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="rounded-lg bg-purple-600 px-6 py-3 font-medium text-white hover:bg-purple-700"
                        :disabled="!form.terms_agreed"
                        :class="{
                            'cursor-not-allowed opacity-50': !form.terms_agreed,
                        }"
                    >
                        Send Your Message
                    </button>
                </div>
            </form>
        </div>
    </section>
</template>

<script setup lang="ts">
import ThreeStars from '@/Components/Icons/ThreeStarsIcon.vue';
import DropdownInput from '@/Components/Shared/Inputs/DropdownInput.vue';
import TextareaInput from '@/Components/Shared/Inputs/TextareaInput.vue';
import TextInput from '@/Components/Shared/Inputs/TextInput.vue';
import { capitalizeFirstLetter } from '@/Composables/useCapitalization';
import { InquiryTypeEnum } from '@/Types/App/Enums/InquiryTypeEnum';
import { SourceEnum } from '@/Types/App/Enums/SourceEnum';
import { LetsConnectFormInterface } from '@/Types/App/Interfaces/LetsConnectFormInterface';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { computed, ComputedRef } from 'vue';

const form: InertiaForm<LetsConnectFormInterface> =
    useForm<LetsConnectFormInterface>({
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        inquiry_type: InquiryTypeEnum.OTHER,
        source: SourceEnum.OTHER,
        message: '',
        terms_agreed: false,
    });

const inquiryTypes: ComputedRef<Record<string, string>> = computed(() =>
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
</script>
