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
                    <button
                        class="rounded-lg bg-purple-600 px-6 py-3 font-medium text-white hover:bg-purple-700"
                    >
                        Explore Properties
                    </button>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black py-8">
        <div class="container mx-auto px-8">
            <div class="mb-12 grid grid-cols-1 gap-8 md:grid-cols-12">
                <div class="flex flex-col space-y-8 md:col-span-3 md:pr-4">
                    <a
                        :href="HomeController().url"
                        target="_self"
                        class="flex items-center"
                    >
                        <div class="mr-2 h-8 w-8 rounded-md">
                            <RealStateIcon />
                        </div>
                        <span
                            class="whitespace-nowrap text-xl font-bold text-white"
                            >Real estate</span
                        >
                    </a>

                    <div
                        class="relative w-full md:w-[150%] md:max-w-[calc(100%+2rem)] md:pr-4"
                    >
                        <input
                            type="email"
                            placeholder="Enter Your Email"
                            class="w-full rounded border border-gray-700 bg-transparent py-2 pl-8 pr-12 text-sm text-white placeholder:text-ellipsis placeholder:text-gray-400 sm:text-xs md:text-sm"
                            aria-label="Enter Your Email"
                        />
                        <span
                            class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-400"
                        >
                            <EmailIcon />
                        </span>
                        <button
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-white md:pr-4"
                        >
                            <SendIcon />
                        </button>
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
                        ©2023 Real estate. All Rights Reserved
                    </p>
                    <a href="#" class="text-sm text-gray-400 hover:text-white">
                        Terms & Conditions
                    </a>
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
import RealStateIcon from '@/Components/Icons/RealStateIcon.vue';
import FooterCategory from '@/Components/Layout/Footer/FooterCategory.vue';
import FooterSocialLink from '@/Components/Layout/Footer/FooterSocialLink/FooterSocialLink.vue';
import EmailIcon from '@/Components/Layout/Footer/Icons/EmailIcon.vue';
import SendIcon from '@/Components/Layout/Footer/Icons/SendIcon.vue';
import HomeController from '@/Routes/actions/App/Http/Controllers/HomeController';
import { SocialLinkIconEnum } from '@/Types/App/Enums';
import {
    FooterCategoryInterface,
    SocialLinkInterface,
} from '@/Types/App/Interfaces';

const footerCategories: FooterCategoryInterface[] = [
    {
        id: 1,
        title: 'Home',
        links: [
            { id: 1, text: 'Hero Section', url: '#' },
            { id: 2, text: 'Features', url: '#' },
            { id: 3, text: 'Properties', url: '#' },
            { id: 4, text: 'Testimonials', url: '#' },
            { id: 5, text: "FAQ's", url: '#' },
        ],
    },
    {
        id: 2,
        title: 'About Us',
        links: [
            { id: 1, text: 'Our Story', url: '#' },
            { id: 2, text: 'Our Works', url: '#' },
            { id: 3, text: 'How It Works', url: '#' },
            { id: 4, text: 'Our Team', url: '#' },
            { id: 5, text: 'Our Clients', url: '#' },
        ],
    },
    {
        id: 3,
        title: 'Properties',
        links: [
            { id: 1, text: 'Portfolio', url: '#' },
            { id: 2, text: 'Categories', url: '#' },
        ],
    },
    {
        id: 4,
        title: 'Services',
        links: [
            { id: 1, text: 'Valuation Mastery', url: '#' },
            { id: 2, text: 'Strategic Marketing', url: '#' },
            { id: 3, text: 'Negotiation Wizardry', url: '#' },
            { id: 4, text: 'Closing Success', url: '#' },
            { id: 5, text: 'Property Management', url: '#' },
        ],
    },
    {
        id: 5,
        title: 'Contact Us',
        links: [
            { id: 1, text: 'Contact Form', url: '#' },
            { id: 2, text: 'Our Offices', url: '#' },
        ],
    },
];

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
        icon: SocialLinkIconEnum.TWITTER,
        url: 'https://www.twitter.com',
    },
    {
        id: 4,
        icon: SocialLinkIconEnum.YOUTUBE,
        url: 'https://www.youtube.com',
    },
];
</script>
