<template>
    <Layout>
        <Journey />
        <Values />
        <Achievements />
        <NavigatingExperience />
        <MeetTeam :team="team" />
        <Clients />
    </Layout>
</template>

<script setup lang="ts">
import Achievements from '@/Components/About/Achievements/Achievements.vue';
import Clients from '@/Components/About/Clients/Clients.vue';
import Journey from '@/Components/About/Journey/Journey.vue';
import MeetTeam from '@/Components/About/MeetTeam/MeetTeam.vue';
import NavigatingExperience from '@/Components/About/NavigatingExperience/NavigatingExperience.vue';
import Values from '@/Components/About/Values/Values.vue';
import Layout from '@/Components/Layout/Layout.vue';
import { displayErrors } from '@/Composables/useErrorHandling';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { TeamInterface } from '@/Types/App/Interfaces/TeamInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    team: TeamInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
