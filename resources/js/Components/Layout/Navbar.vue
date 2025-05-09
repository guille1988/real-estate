<template>
    <header class="bg-black py-6 text-white">
        <div class="container mx-auto flex items-center justify-between px-4">
            <div class="flex items-center">
                <img
                    :src="realStateLogo"
                    width="48"
                    height="48"
                    alt="Real estate logo"
                    class="object-contain"
                />
                <span class="ml-4 text-xl font-bold">Real estate</span>
            </div>

            <nav>
                <ul class="flex space-x-8">
                    <li>
                        <Link
                            :href="HomeController().url"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(PagesEnum.HOME),
                            }"
                        >
                            Home
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="AboutController().url"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(PagesEnum.ABOUT),
                            }"
                        >
                            About Us
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="PropertyController.index().url"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(PagesEnum.PROPERTIES),
                            }"
                        >
                            Properties
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="ServiceController().url"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(PagesEnum.SERVICES),
                            }"
                        >
                            Services
                        </Link>
                    </li>
                </ul>
            </nav>

            <div>
                <Link
                    :href="ContactController().url"
                    class="rounded-md bg-purple-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:text-black"
                    :class="{
                        'pointer-events-none opacity-0': !isNotPage(
                            PagesEnum.CONTACT,
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
import realStateLogo from '@/Assets/Images/real_state_logo.jpg';
import AboutController from '@/Routes/actions/App/Http/Controllers/AboutController';
import ContactController from '@/Routes/actions/App/Http/Controllers/ContactController';
import HomeController from '@/Routes/actions/App/Http/Controllers/HomeController';
import PropertyController from '@/Routes/actions/App/Http/Controllers/PropertyController';
import ServiceController from '@/Routes/actions/App/Http/Controllers/ServiceController';
import { PagesEnum } from '@/Types/App/Enums';
import { Link, usePage } from '@inertiajs/vue3';

const isPage = (page: PagesEnum): boolean => usePage().component === page;
const isNotPage = (page: PagesEnum): boolean => !isPage(page);
</script>
