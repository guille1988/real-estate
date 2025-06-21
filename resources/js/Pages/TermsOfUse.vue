<template>
    <Layout>
        <div class="w-full bg-black">
            <div class="container mx-auto px-4 py-12">
                <h1 class="mb-8 text-4xl font-bold">Terms of Use</h1>

                <div class="prose prose-lg prose-invert max-w-none">
                    <TermsOfUseSection
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
import TermsOfUseSection from '@/Components/TermsOfUse/TermsOfUseSection.vue';
import { TermsOfUseInterface } from '@/Types/App/Interfaces/TermsOfUseInterface';
import { router } from '@inertiajs/vue3';

defineProps<{ previous_url: string }>();

const sections: TermsOfUseInterface[] = [
    {
        title: '1. Acceptance of Terms',
        content:
            'By accessing and using this website, you accept and agree to be bound by the terms and provisions of this agreement. If you do not agree to abide by the above, please do not use this service.',
    },
    {
        title: '2. Use License',
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
        title: '3. Disclaimer',
        content:
            "The materials on this website are provided on an 'as is' basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.",
    },
    {
        title: '4. Limitations',
        content:
            'In no event shall we or our suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on this website, even if we or an authorized representative has been notified orally or in writing of the possibility of such damage.',
    },
    {
        title: '5. Revisions and Errata',
        content:
            'The materials appearing on this website could include technical, typographical, or photographic errors. We do not warrant that any of the materials on this website are accurate, complete or current. We may make changes to the materials contained on this website at any time without notice.',
    },
    {
        title: '6. Links',
        content:
            "We have not reviewed all of the sites linked to this website and are not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by us of the site. Use of any such linked website is at the user's own risk.",
    },
    {
        title: '7. Modifications to Terms of Use',
        content:
            'We may revise these terms of use for this website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.',
    },
    {
        title: '8. Governing Law',
        content:
            'These terms and conditions are governed by and construed in accordance with the laws and you irrevocably submit to the exclusive jurisdiction of the courts in that location.',
    },
];
</script>
