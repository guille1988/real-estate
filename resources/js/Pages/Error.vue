<template>
    <section
        class="flex min-h-screen items-center justify-center bg-black pb-32 text-white"
    >
        <div class="container mx-auto px-6 py-16 text-center">
            <div
                class="mx-auto mb-8 flex h-24 w-24 items-center justify-center rounded-2xl bg-purple-600/10 ring-1 ring-purple-600/30"
            >
                <RealEstateIcon />
            </div>

            <p class="text-sm uppercase tracking-widest text-purple-400">
                Error {{ statusCode }}
            </p>

            <h1 class="mt-2 text-4xl font-bold sm:text-5xl">
                {{ title }}
            </h1>
            <p
                class="mx-auto mt-5 max-w-3xl text-base text-gray-400 sm:text-lg"
            >
                {{ description }}
            </p>

            <div
                class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row"
            >
                <Link
                    prefetch
                    :href="HomeController().url"
                    class="inline-flex items-center justify-center rounded-md bg-purple-600 px-8 py-3 text-base font-medium text-white transition-colors hover:bg-purple-500"
                >
                    Go to homepage
                </Link>
                <button
                    type="button"
                    @click="goBack()"
                    class="inline-flex items-center justify-center rounded-md border border-purple-600/50 px-8 py-3 text-base font-medium text-white/90 transition-colors hover:border-purple-500 hover:text-white"
                >
                    Go back
                </button>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import RealEstateIcon from '@/Components/Icons/RealEstateIcon.vue';
import HomeController from '@/Routes/actions/App/Http/Controllers/HomeController';
import { Link, router } from '@inertiajs/vue3';
import { computed, Ref } from 'vue';

const { statusCode }: { statusCode: number } = defineProps<{
    statusCode: number;
}>();

const titles: Record<number, string> = {
    503: 'Service Unavailable',
    500: 'Server Error',
    404: 'Page Not Found',
    403: 'Forbidden',
};

const descriptions: Record<number, string> = {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
};

const title: Ref<string> = computed(
    (): string => titles[statusCode] ?? titles[500],
);
const description: Ref<string> = computed(
    (): string => descriptions[statusCode] ?? descriptions[500],
);

const goBack = (): void => {
    if (window.history.length > 1) {
        window.history.back();
        return;
    }

    router.visit(HomeController().url);
};
</script>
