<template>
    <header class="bg-black py-6 text-white">
        <div class="container mx-auto flex items-center justify-between px-4">
            <div class="flex items-center">
                <a
                    :href="HomeController().url"
                    target="_self"
                    class="flex items-center"
                >
                    <RealStateIcon />
                    <span class="ml-4 text-xl font-bold">Real estate</span>
                </a>
            </div>

            <button
                @click="toggleMobileMenu"
                class="focus:outline-none lg:hidden"
                aria-label="Toggle menu"
            >
                <TurtleIcon :mobile-menu-opened="mobileMenuOpened" />
            </button>

            <nav class="hidden lg:block">
                <ul class="flex space-x-8">
                    <li
                        v-for="navigationPage in navigationPages"
                        :key="navigationPage.name"
                    >
                        <Link
                            :href="navigationPage.url"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(navigationPage.page),
                            }"
                        >
                            {{ navigationPage.name }}
                        </Link>
                    </li>
                </ul>
            </nav>

            <div class="hidden lg:block">
                <Link
                    :href="ContactController().url"
                    class="rounded-md bg-purple-600 px-6 py-2 text-sm font-medium text-white transition-colors hover:text-black"
                    :class="{
                        'pointer-events-none opacity-0': isPage(
                            PagesEnum.CONTACT,
                        ),
                    }"
                >
                    Contact Us
                </Link>
            </div>
        </div>

        <div v-show="mobileMenuOpened" class="lg:hidden">
            <div
                class="container mx-auto bg-neutral-900 px-4 py-4 transition-all duration-300 ease-in-out"
            >
                <ul class="flex flex-col space-y-4">
                    <li
                        v-for="navigationPage in navigationPages"
                        :key="navigationPage.name"
                    >
                        <Link
                            :href="navigationPage.url"
                            class="block rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-l-4 border-purple-600 bg-black pl-4 shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isPage(navigationPage.page),
                            }"
                            @click="closeMobileMenu"
                        >
                            {{ navigationPage.name }}
                        </Link>
                    </li>
                    <li v-if="isNotPage(PagesEnum.CONTACT)">
                        <Link
                            :href="ContactController().url"
                            class="block w-full rounded-md bg-purple-600 px-6 py-2 text-center text-sm font-medium text-white transition-colors hover:text-black"
                            @click="closeMobileMenu"
                        >
                            Contact Us
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import RealStateIcon from '@/Components/Icons/RealStateIcon.vue';
import TurtleIcon from '@/Components/Icons/TurtleIcon.vue';
import AboutController from '@/Routes/actions/App/Http/Controllers/AboutController';
import ContactController from '@/Routes/actions/App/Http/Controllers/ContactController';
import HomeController from '@/Routes/actions/App/Http/Controllers/HomeController';
import PropertyController from '@/Routes/actions/App/Http/Controllers/PropertyController';
import ServiceController from '@/Routes/actions/App/Http/Controllers/ServiceController';
import { PagesEnum } from '@/Types/App/Enums/PagesEnum';
import { NavigationPagesInterface } from '@/Types/App/Interfaces/NavigationPagesInterface';
import { Link, usePage } from '@inertiajs/vue3';
import { Ref, ref } from 'vue';

const isPage = (page: PagesEnum): boolean => usePage().component === page;
const isNotPage = (page: PagesEnum): boolean => !isPage(page);

const mobileMenuOpened: Ref<boolean> = ref<boolean>(false);

const toggleMobileMenu = (): void => {
    mobileMenuOpened.value = !mobileMenuOpened.value;
};

const closeMobileMenu = (): void => {
    mobileMenuOpened.value = false;
};

const navigationPages: NavigationPagesInterface[] = [
    {
        name: 'Home',
        url: HomeController().url,
        page: PagesEnum.HOME,
    },
    {
        name: 'About Us',
        url: AboutController().url,
        page: PagesEnum.ABOUT,
    },
    {
        name: 'Properties',
        url: PropertyController.index().url,
        page: PagesEnum.PROPERTIES,
    },
    {
        name: 'Services',
        url: ServiceController().url,
        page: PagesEnum.SERVICES,
    },
];
</script>
