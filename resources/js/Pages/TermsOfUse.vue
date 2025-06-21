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
        title: '1. Acceptance of Terms',
        is_string: true,
        content:
            'By accessing and using this website, you accept and agree to be bound by the terms and provisions of this agreement. If you do not agree to abide by the above, please do not use this service.',
    },
    {
        id: 2,
        title: '2. Use License',
        is_string: false,
        content: [
            'Permission is granted to temporarily download one copy of the materials on this website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:',
            'Modify or copy the materials',
            'Use the materials for any commercial purpose',
            'Attempt to decompile or reverse engineer any software contained on the website',
            'Remove any copyright or other proprietary notations from the materials',
            'Transfer the materials to another person or "mirror" the materials on any other server',
        ],
    },
    {
        id: 3,
        title: '3. Disclaimer',
        is_string: true,
        content:
            "The materials on this website are provided on an 'as is' basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.",
    },
    {
        id: 4,
        title: '4. Limitations',
        is_string: true,
        content:
            'In no event shall we or our suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on this website, even if we or an authorized representative has been notified orally or in writing of the possibility of such damage.',
    },
    {
        id: 5,
        title: '5. Revisions and Errata',
        is_string: true,
        content:
            'The materials appearing on this website could include technical, typographical, or photographic errors. We do not warrant that any of the materials on this website are accurate, complete or current. We may make changes to the materials contained on this website at any time without notice.',
    },
    {
        id: 6,
        title: '6. Links',
        is_string: true,
        content:
            "We have not reviewed all of the sites linked to this website and are not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by us of the site. Use of any such linked website is at the user's own risk.",
    },
    {
        id: 7,
        title: '7. Modifications to Terms of Use',
        is_string: true,
        content:
            'We may revise these terms of use for this website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.',
    },
    {
        id: 8,
        title: '8. Governing Law',
        is_string: true,
        content:
            'These terms and conditions are governed by and construed in accordance with the laws and you irrevocably submit to the exclusive jurisdiction of the courts in that location.',
    },
];

const section: LegalSectionInterface = {
    id: 1,
    title: 'Terms of Use',
    section_items: sectionItems,
    previous_url: properties.previous_url,
};
</script>
