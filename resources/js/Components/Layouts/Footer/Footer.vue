<template>
    <section class="bg-black py-8">
        <div class="container mx-auto px-8 pt-8">
            <div
                class="flex flex-col items-start justify-between space-y-6 lg:flex-row lg:items-center lg:space-y-0"
            >
                <div class="max-w-2xl">
                    <h2 class="mb-4 text-3xl font-bold text-white">
                        Start Your Real Estate Journey Today
                    </h2>
                    <p class="text-gray-400">
                        Your dream property is just a click away. Whether you're
                        looking for a new home, a strategic investment, or
                        expert real estate advice, Real estate is here to assist
                        you every step of the way. Take the first step towards
                        your real estate goals and explore our available
                        properties or get in touch with our team for
                        personalized assistance.
                    </p>
                </div>
                <div class="mt-4 pr-8 lg:mt-0">
                    <Link prefetch :href="useSection('search-property')">
                        <button
                            class="rounded-lg bg-purple-600 px-6 py-3 font-medium text-white hover:bg-purple-700"
                        >
                            Explore Properties
                        </button>
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black py-8">
        <div class="container mx-auto px-8">
            <div class="mb-12 grid grid-cols-1 gap-8 md:grid-cols-12">
                <div class="flex flex-col space-y-8 md:col-span-3 md:pr-4">
                    <Link
                        prefetch
                        :href="HomeController().url"
                        class="flex items-center"
                    >
                        <div class="mr-2 h-8 w-8 rounded-md">
                            <RealEstateIcon />
                        </div>
                        <span
                            class="whitespace-nowrap text-xl font-bold text-white"
                            >Real estate</span
                        >
                    </Link>

                    <div
                        class="relative w-full md:w-[150%] md:max-w-[calc(100%+2rem)] md:pr-4"
                    >
                        <form @submit.prevent="submit()" class="relative">
                            <input
                                type="email"
                                name="email"
                                v-model="form.email"
                                placeholder="Enter Your Email To Receive Updates"
                                class="w-full rounded border border-gray-700 bg-transparent py-2 pl-8 pr-12 text-sm text-white placeholder:text-ellipsis placeholder:text-gray-400 sm:text-xs md:text-sm"
                                aria-label="Enter Your Email"
                            />
                            <span
                                class="pointer-events-none absolute left-2 top-1/2 -translate-y-1/2 text-gray-400"
                            >
                                <EmailIcon class="mr-2 h-4 w-4 text-white" />
                            </span>
                            <button
                                type="submit"
                                class="absolute right-2 top-1/2 flex h-4 w-4 -translate-y-1/2 items-center justify-center leading-none text-white"
                                :disabled="disableButton"
                                :class="{
                                    'cursor-not-allowed opacity-50':
                                        disableButton,
                                }"
                            >
                                <SendIcon class="lucide lucide-send h-4 w-4" />
                            </button>
                        </form>
                        <p
                            v-if="form.errors.email"
                            class="mt-2 text-sm text-red-500 dark:text-red-400"
                        >
                            {{ form.errors.email }}
                        </p>
                        <p
                            v-if="showSuccessMessage"
                            class="mt-2 text-sm text-green-400"
                        >
                            {{ successMessage }}
                        </p>
                    </div>
                </div>

                <div class="md:col-span-9 md:flex md:justify-end">
                    <div
                        class="grid grid-cols-1 gap-8 md:grid-cols-3 lg:grid-cols-5"
                    >
                        <FooterCategory
                            v-for="footerCategory in footerCategories"
                            :key="footerCategory.id"
                            :category="footerCategory"
                        />
                    </div>
                </div>
            </div>

            <div
                class="flex flex-col items-center justify-between border-t border-gray-800 pt-6 md:flex-row"
            >
                <div
                    class="flex flex-col items-center space-y-2 md:flex-row md:items-start md:space-x-4 md:space-y-0"
                >
                    <p class="text-sm text-gray-400">
                        ©2025 Real estate. All Rights Reserved
                    </p>
                </div>

                <div class="mt-4 flex space-x-4 md:mt-0">
                    <FooterSocialLink
                        v-for="socialLink in socialLinks"
                        :key="socialLink.id"
                        :social-link="socialLink"
                    />
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup lang="ts">
import EmailIcon from '@/Components/Icons/EmailIcon.vue';
import RealEstateIcon from '@/Components/Icons/RealEstateIcon.vue';
import SendIcon from '@/Components/Icons/SendIcon.vue';
import FooterCategory from '@/Components/Layouts/Footer/FooterCategory.vue';
import FooterSocialLink from '@/Components/Layouts/Footer/FooterSocialLink.vue';
import { useSection } from '@/Composables/useSection';
import HomeController from '@/Routes/actions/App/Http/Controllers/HomeController';
import { SocialLinkIconEnum } from '@/Types/App/Enums/SocialLinkIconEnum';
import { FooterCategoryInterface } from '@/Types/App/Interfaces/FooterCategoryInterface';
import { SocialLinkInterface } from '@/Types/App/Interfaces/SocialLinkInterface';
import { InertiaForm, Link, useForm } from '@inertiajs/vue3';

const footerCategories: FooterCategoryInterface[] = [
    {
        id: 1,
        title: 'Home',
        links: [
            {
                id: 1,
                text: 'Featured Properties',
                url: useSection('featured-properties'),
            },
            {
                id: 2,
                text: 'Testimonials',
                url: useSection('testimonials'),
            },
            {
                id: 3,
                text: "FAQ's",
                url: useSection('faq'),
            },
        ],
    },
    {
        id: 2,
        title: 'About Us',
        links: [
            {
                id: 1,
                text: 'Our Journey',
                url: useSection('journey'),
            },
            {
                id: 2,
                text: 'Our Values',
                url: useSection('values'),
            },
            {
                id: 3,
                text: 'Our Achievements',
                url: useSection('achievements'),
            },
            {
                id: 4,
                text: 'Our Experience',
                url: useSection('navigating-experience'),
            },
            {
                id: 5,
                text: 'Our Clients',
                url: useSection('clients'),
            },
        ],
    },
    {
        id: 3,
        title: 'Properties',
        links: [
            {
                id: 1,
                text: 'Find Your Dream Property',
                url: useSection('search-property'),
            },
            {
                id: 2,
                text: 'Make It Happen',
                url: useSection('make-it-happen'),
            },
        ],
    },
    {
        id: 4,
        title: 'Services',
        links: [
            {
                id: 1,
                text: 'Elevate Experience',
                url: useSection('elevate-experience'),
            },
            {
                id: 2,
                text: 'Property Value',
                url: useSection('unlock-property-value'),
            },
            {
                id: 3,
                text: 'Property Management',
                url: useSection('effortless-property-management'),
            },
            {
                id: 4,
                text: 'Smart Investments',
                url: useSection('smart-investments'),
            },
        ],
    },
    {
        id: 5,
        title: 'Contact Us',
        links: [
            {
                id: 1,
                text: 'Contact Form',
                url: useSection('lets-connect'),
            },
            {
                id: 2,
                text: 'Our Offices',
                url: useSection('office-locations'),
            },
        ],
    },
];

import SubscriberController from '@/Routes/actions/App/Http/Controllers/SubscriberController';
import { ref, type Ref } from 'vue';

const successMessage: string = 'Thanks for subscribing!';
const showSuccessMessage: Ref<boolean> = ref<boolean>(false);
const disableButton: Ref<boolean> = ref<boolean>(false);

const form: InertiaForm<{ email: string }> = useForm<{ email: string }>({
    email: '',
});

const submit = (): void => {
    showSuccessMessage.value = false;
    disableButton.value = true;

    form.post(SubscriberController().url, {
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
        onFinish: (): void => {
            setTimeout((): void => {
                disableButton.value = false;
            }, 4000);
        },
    });
};

const socialLinks: SocialLinkInterface[] = [
    {
        id: 1,
        icon: SocialLinkIconEnum.FACEBOOK,
        url: 'https://www.facebook.com',
    },
    {
        id: 2,
        icon: SocialLinkIconEnum.LINKEDIN,
        url: 'https://www.linkedin.com',
    },
    {
        id: 3,
        icon: SocialLinkIconEnum.X,
        url: 'https://www.x.com',
    },
    {
        id: 4,
        icon: SocialLinkIconEnum.YOUTUBE,
        url: 'https://www.youtube.com',
    },
];
</script>
