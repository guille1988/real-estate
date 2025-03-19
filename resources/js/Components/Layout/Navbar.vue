<template>
    <header class="bg-black py-4 text-white">
        <div class="container mx-auto flex items-center justify-between px-4">
            <div class="flex items-center">
                <svg
                    width="32"
                    height="32"
                    viewBox="0 0 32 32"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M16 0C7.163 0 0 7.163 0 16C0 24.837 7.163 32 16 32C24.837 32 32 24.837 32 16C32 7.163 24.837 0 16 0ZM16 24C11.582 24 8 20.418 8 16C8 11.582 11.582 8 16 8C20.418 8 24 11.582 24 16C24 20.418 20.418 24 16 24Z"
                        fill="#9333EA"
                    />
                </svg>
                <span class="ml-2 text-xl font-bold">Real estate</span>
            </div>

            <nav>
                <ul class="flex space-x-8">
                    <li>
                        <Link
                            :href="route('home')"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(Pages.HOME),
                            }"
                        >
                            Home
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('about')"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(Pages.ABOUT),
                            }"
                        >
                            About Us
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('properties.index')"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(Pages.PROPERTIES),
                            }"
                        >
                            Properties
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('services')"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(Pages.SERVICES),
                            }"
                        >
                            Services
                        </Link>
                    </li>
                </ul>
            </nav>

            <div>
                <Link
                    :href="route('contact')"
                    class="rounded-md bg-purple-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:text-black"
                    :class="{
                        'pointer-events-none opacity-0': !isNotPage(
                            Pages.CONTACT,
                        ),
                    }"
                >
                    Contact Us
                </Link>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import { Pages } from '@/Enums/Pages';
import { Link, usePage } from '@inertiajs/vue3';

const isPage = (page: Pages): boolean => usePage().component === page;
const isNotPage = (page: Pages): boolean => !isPage(page);
</script>
