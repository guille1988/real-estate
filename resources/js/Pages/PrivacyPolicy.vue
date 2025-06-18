<template>
    <Layout>
        <div class="w-full bg-black">
            <div class="container mx-auto px-4 py-12">
                <h1 class="mb-8 text-4xl font-bold">Privacy Policy</h1>

                <div class="prose prose-lg prose-invert max-w-none">
                    <h2
                        class="mb-4 mt-8 text-2xl font-semibold text-purple-500"
                    >
                        1. Introduction
                    </h2>
                    <p>
                        We respect your privacy and are committed to protecting
                        your personal data. This privacy policy will inform you
                        about how we look after your personal data when you
                        visit our website and tell you about your privacy rights
                        and how the law protects you.
                    </p>

                    <h2
                        class="mb-4 mt-8 text-2xl font-semibold text-purple-500"
                    >
                        2. The Data We Collect About You
                    </h2>
                    <p>
                        Personal data, or personal information, means any
                        information about an individual from which that person
                        can be identified. We may collect, use, store and
                        transfer different kinds of personal data about you
                        which we have grouped together as follows:
                    </p>
                    <ul class="mb-4 list-disc pl-6">
                        <li>
                            Identity Data includes first name, last name,
                            username or similar identifier.
                        </li>
                        <li>
                            Contact Data includes email address and telephone
                            numbers.
                        </li>
                        <li>
                            Technical Data includes internet protocol (IP)
                            address, browser type and version, time zone setting
                            and location, browser plug-in types and versions,
                            operating system and platform, and other technology
                            on the devices you use to access this website.
                        </li>
                        <li>
                            Usage Data includes information about how you use
                            our website and services.
                        </li>
                    </ul>

                    <h2
                        class="mb-4 mt-8 text-2xl font-semibold text-purple-500"
                    >
                        3. How We Use Your Personal Data
                    </h2>
                    <p>
                        We will only use your personal data when the law allows
                        us to. Most commonly, we will use your personal data in
                        the following circumstances:
                    </p>
                    <ul class="mb-4 list-disc pl-6">
                        <li>
                            Where we need to perform the contract we are about
                            to enter into or have entered into with you.
                        </li>
                        <li>
                            Where it is necessary for our legitimate interests
                            (or those of a third party) and your interests and
                            fundamental rights do not override those interests.
                        </li>
                        <li>
                            Where we need to comply with a legal obligation.
                        </li>
                    </ul>

                    <h2
                        class="mb-4 mt-8 text-2xl font-semibold text-purple-500"
                    >
                        4. Data Security
                    </h2>
                    <p>
                        We have put in place appropriate security measures to
                        prevent your personal data from being accidentally lost,
                        used or accessed in an unauthorized way, altered or
                        disclosed. In addition, we limit access to your personal
                        data to those employees, agents, contractors and other
                        third parties who have a business need to know.
                    </p>

                    <h2
                        class="mb-4 mt-8 text-2xl font-semibold text-purple-500"
                    >
                        5. Data Retention
                    </h2>
                    <p>
                        We will only retain your personal data for as long as
                        reasonably necessary to fulfill the purposes we
                        collected it for, including for the purposes of
                        satisfying any legal, regulatory, tax, accounting or
                        reporting requirements.
                    </p>

                    <h2
                        class="mb-4 mt-8 text-2xl font-semibold text-purple-500"
                    >
                        6. Your Legal Rights
                    </h2>
                    <p>
                        Under certain circumstances, you have rights under data
                        protection laws in relation to your personal data,
                        including the right to:
                    </p>
                    <ul class="mb-4 list-disc pl-6">
                        <li>Request access to your personal data.</li>
                        <li>Request correction of your personal data.</li>
                        <li>Request erasure of your personal data.</li>
                        <li>Object to processing of your personal data.</li>
                        <li>
                            Request restriction of processing your personal
                            data.
                        </li>
                        <li>Request transfer of your personal data.</li>
                        <li>Right to withdraw consent.</li>
                    </ul>

                    <h2
                        class="mb-4 mt-8 text-2xl font-semibold text-purple-500"
                    >
                        7. Changes to the Privacy Policy
                    </h2>
                    <p>
                        We may update our privacy policy from time to time. We
                        will notify you of any changes by posting the new
                        privacy policy on this page.
                    </p>

                    <h2
                        class="mb-4 mt-8 text-2xl font-semibold text-purple-500"
                    >
                        8. Contact Us
                    </h2>
                    <p>
                        If you have any questions about this privacy policy or
                        our privacy practices, please contact us.
                    </p>

                    <div class="mt-12 text-right">
                        <button
                            @click="router.visit(backUrl)"
                            class="rounded-md bg-purple-500 px-6 py-3 text-white transition duration-300 hover:bg-purple-600"
                        >
                            Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';
import { BackUrlInterface } from '@/Types/App/Interfaces/BackUrlInterface';
import { router } from '@inertiajs/vue3';
import { computed, ComputedRef } from 'vue';

const { url, fragment }: BackUrlInterface = defineProps<BackUrlInterface>();

const backUrl: ComputedRef<string> = computed((): string => {
    return url && fragment
        ? `${url}${fragment}`
        : url || document.referrer || '/';
});
</script>
