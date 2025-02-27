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
                <span class="ml-2 text-xl font-bold">Real State</span>
            </div>

            <nav>
                <ul class="flex space-x-8">
                    <li>
                        <a
                            href="#"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isActive('home'),
                            }"
                        >
                            Home
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isActive('about'),
                            }"
                        >
                            About Us
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isActive('properties'),
                            }"
                        >
                            Properties
                        </a>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="rounded px-3 py-2 transition-colors hover:text-purple-400"
                            :class="{
                                'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                                    isActive('services'),
                            }"
                        >
                            Services
                        </a>
                    </li>
                </ul>
            </nav>

            <div>
                <a
                    href="#"
                    class="rounded px-4 py-2 transition-colors hover:text-purple-400"
                    :class="{
                        'border-b-2 border-purple-600 bg-black shadow-[0_0_10px_rgba(0,0,0,0.5)]':
                            isActive('contact'),
                    }"
                >
                    Contact Us
                </a>
            </div>
        </div>
    </header>
</template>

<script lang="ts" setup>
import { ref } from 'vue';

const activeItem = ref('home');

const isActive = (item: string) => {
    return activeItem.value === item;
};
</script>
