<template>
    <Layout>
        <div class="w-full bg-black">
            <div class="container mx-auto px-4 py-12">
                <h1 class="mb-8 text-4xl font-bold">Privacy Policy</h1>

                <div class="prose prose-lg prose-invert max-w-none">
                    <PrivacyPolicySection
                        v-for="(section, index) in sections"
                        :key="index"
                        :section="section"
                    />

                    <div class="mt-12 text-right">
                        <button
                            @click="router.visit(previous_url)"
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
import PrivacyPolicySection from '@/Components/PrivacyPolicy/PrivacyPolicySection.vue';
import { PrivacyPolicyInterface } from '@/Types/App/Interfaces/PrivacyPolicyInterface';
import { router } from '@inertiajs/vue3';

defineProps<{ previous_url: string }>();

const sections: PrivacyPolicyInterface[] = [
    {
        title: '1. Introduction',
        content:
            'We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights and how the law protects you.',
    },
    {
        title: '2. The Data We Collect About You',
        content: [
            'Personal data, or personal information, means any information about an individual from which that person can be identified. We may collect, use, store and transfer different kinds of personal data about you which we have grouped together as follows:',
            'Identity Data includes first name, last name, username or similar identifier.',
            'Contact Data includes email address and telephone numbers.',
            'Technical Data includes internet protocol (IP) address, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, and other technology on the devices you use to access this website.',
            'Usage Data includes information about how you use our website and services.',
        ],
    },
    {
        title: '3. How We Use Your Personal Data',
        content: [
            'We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:',
            'Where we need to perform the contract we are about to enter into or have entered into with you.',
            'Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests.',
            'Where we need to comply with a legal obligation.',
        ],
    },
    {
        title: '4. Data Security',
        content:
            'We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorized way, altered or disclosed. In addition, we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know.',
    },
    {
        title: '5. Data Retention',
        content:
            'We will only retain your personal data for as long as reasonably necessary to fulfill the purposes we collected it for, including for the purposes of satisfying any legal, regulatory, tax, accounting or reporting requirements.',
    },
    {
        title: '6. Your Legal Rights',
        content: [
            'Under certain circumstances, you have rights under data protection laws in relation to your personal data, including the right to:',
            'Request access to your personal data.',
            'Request correction of your personal data.',
            'Request erasure of your personal data.',
            'Object to processing of your personal data.',
            'Request restriction of processing your personal data.',
            'Request transfer of your personal data.',
            'Right to withdraw consent.',
        ],
    },
    {
        title: '7. Changes to the Privacy Policy',
        content:
            'We may update our privacy policy from time to time. We will notify you of any changes by posting the new privacy policy on this page.',
    },
    {
        title: '8. Contact Us',
        content:
            'If you have any questions about this privacy policy or our privacy practices, please contact us.',
    },
];
</script>
