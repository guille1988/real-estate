<template>
    <section class="bg-black py-8">
        <div class="container mx-auto px-8">
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
                    <div class="flex items-center">
                        <div class="mr-2 h-8 w-8 rounded-md">
                            <img
                                :src="realStateLogo"
                                width="48"
                                height="48"
                                alt="Real estate logo"
                                class="object-contain"
                            />
                        </div>
                        <span class="text-xl font-bold text-white"
                            >Real estate</span
                        >
                    </div>

                    <div
                        class="relative w-full pt-2 md:w-[150%] md:max-w-[calc(100%+2rem)] md:overflow-hidden"
                    >
                        <input
                            type="email"
                            placeholder="Enter Your Email"
                            class="w-full rounded border border-gray-700 bg-transparent py-2 pl-8 pr-10 text-sm text-white"
                        />
                        <span
                            class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-400"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-mail"
                            >
                                <rect
                                    width="20"
                                    height="16"
                                    x="2"
                                    y="4"
                                    rx="2"
                                />
                                <path
                                    d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"
                                />
                            </svg>
                        </span>
                        <button
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-white"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-send"
                            >
                                <path d="m22 2-7 20-4-9-9-4Z" />
                                <path d="M22 2 11 13" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="md:col-span-9 md:flex md:justify-end">
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 md:gap-6 lg:grid-cols-5 lg:gap-8"
                    >
                        <div
                            v-for="(category, index) in footerLinks"
                            :key="index"
                            class="mt-4 md:mt-0"
                        >
                            <h3 class="mb-4 text-sm font-semibold text-white">
                                {{ category.title }}
                            </h3>
                            <ul class="space-y-2 text-sm text-gray-400">
                                <li
                                    v-for="(link, linkIndex) in category.links"
                                    :key="linkIndex"
                                >
                                    <a
                                        :href="link.url"
                                        class="hover:text-white"
                                    >
                                        {{ link.text }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="flex flex-col items-center justify-between border-t border-gray-800 pt-6 md:flex-row"
            >
                <div class="flex flex-col items-center sm:flex-row">
                    <p class="mb-4 text-sm text-gray-400 sm:mr-4 md:mb-0">
                        ©2023 Real estate. All Rights Reserved
                    </p>
                    <a
                        href="#"
                        class="mb-4 text-sm text-gray-400 hover:text-white sm:mb-0"
                        >Terms & Conditions</a
                    >
                </div>

                <div class="flex space-x-4">
                    <a
                        v-for="(social, index) in socialLinks"
                        :key="index"
                        href="#"
                        class="text-gray-400 hover:text-white"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            :class="`lucide lucide-${social.icon}`"
                        >
                            <path
                                v-if="social.icon === 'facebook'"
                                d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
                            />
                            <template v-else-if="social.icon === 'linkedin'">
                                <path
                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"
                                />
                                <rect width="4" height="12" x="2" y="9" />
                                <circle cx="4" cy="4" r="2" />
                            </template>
                            <path
                                v-else-if="social.icon === 'twitter'"
                                d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"
                            />
                            <template v-else-if="social.icon === 'youtube'">
                                <path
                                    d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"
                                />
                                <path d="m10 15 5-3-5-3z" />
                            </template>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup lang="ts">
import realStateLogo from '@/Assets/Images/real_state_logo.jpg';
import {
    FooterCategoryInterface,
    SocialLinkInterface,
} from '@/Types/App/Interfaces';

const footerLinks: FooterCategoryInterface[] = [
    {
        title: 'Home',
        links: [
            { text: 'Hero Section', url: '#' },
            { text: 'Features', url: '#' },
            { text: 'Properties', url: '#' },
            { text: 'Testimonials', url: '#' },
            { text: "FAQ's", url: '#' },
        ],
    },
    {
        title: 'About Us',
        links: [
            { text: 'Our Story', url: '#' },
            { text: 'Our Works', url: '#' },
            { text: 'How It Works', url: '#' },
            { text: 'Our Team', url: '#' },
            { text: 'Our Clients', url: '#' },
        ],
    },
    {
        title: 'Properties',
        links: [
            { text: 'Portfolio', url: '#' },
            { text: 'Categories', url: '#' },
        ],
    },
    {
        title: 'Services',
        links: [
            { text: 'Valuation Mastery', url: '#' },
            { text: 'Strategic Marketing', url: '#' },
            { text: 'Negotiation Wizardry', url: '#' },
            { text: 'Closing Success', url: '#' },
            { text: 'Property Management', url: '#' },
        ],
    },
    {
        title: 'Contact Us',
        links: [
            { text: 'Contact Form', url: '#' },
            { text: 'Our Offices', url: '#' },
        ],
    },
];

const socialLinks: SocialLinkInterface[] = [
    { icon: 'facebook', url: '#' },
    { icon: 'linkedin', url: '#' },
    { icon: 'twitter', url: '#' },
    { icon: 'youtube', url: '#' },
];
</script>
