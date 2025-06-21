<template>
    <Layout>
        <LegalSection :section="section" />
    </Layout>
</template>

<script setup lang="ts">
import Layout from '@/Components/Layout/Layout.vue';

import LegalSection from '@/Components/Shared/Legal/LegalSection.vue';
import { LegalPagePropertiesInterface } from '@/Types/App/Interfaces/LegalPagePropertiesInterface';
import { LegalSectionInterface } from '@/Types/App/Interfaces/LegalSectionInterface';
import { LegalSectionItemInterface } from '@/Types/App/Interfaces/LegalSectionItemInterface';

const properties: LegalPagePropertiesInterface = defineProps<{
    previous_url: string;
}>();

const sectionItems: LegalSectionItemInterface[] = [
    {
        id: 1,
        title: '1. Introduction',
        is_string: true,
        content:
            'We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights and how the law protects you.',
    },
    {
        id: 2,
        title: '2. The Data We Collect About You',
        is_string: false,
        content: [
            'Personal data, or personal information, means any information about an individual from which that person can be identified. We may collect, use, store and transfer different kinds of personal data about you which we have grouped together as follows:',
            'Identity Data includes first name, last name, username or similar identifier.',
            'Contact Data includes email address and telephone numbers.',
            'Technical Data includes internet protocol (IP) address, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, and other technology on the devices you use to access this website.',
            'Usage Data includes information about how you use our website and services.',
        ],
    },
    {
        id: 3,
        title: '3. How We Use Your Personal Data',
        is_string: false,
        content: [
            'We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:',
            'Where we need to perform the contract we are about to enter into or have entered into with you.',
            'Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests.',
            'Where we need to comply with a legal obligation.',
        ],
    },
    {
        id: 4,
        title: '4. Data Security',
        is_string: true,
        content:
            'We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorized way, altered or disclosed. In addition, we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know.',
    },
    {
        id: 5,
        title: '5. Data Retention',
        is_string: true,
        content:
            'We will only retain your personal data for as long as reasonably necessary to fulfill the purposes we collected it for, including for the purposes of satisfying any legal, regulatory, tax, accounting or reporting requirements.',
    },
    {
        id: 6,
        title: '6. Your Legal Rights',
        is_string: false,
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
        id: 7,
        title: '7. Changes to the Privacy Policy',
        is_string: true,
        content:
            'We may update our privacy policy from time to time. We will notify you of any changes by posting the new privacy policy on this page.',
    },
    {
        id: 8,
        title: '8. Contact Us',
        is_string: true,
        content:
            'If you have any questions about this privacy policy or our privacy practices, please contact us.',
    },
];

const section: LegalSectionInterface = {
    id: 1,
    title: 'Privacy Policy',
    section_items: sectionItems,
    previous_url: properties.previous_url,
};
</script>
