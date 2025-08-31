<template>
    <Layout>
        <Journey :house="assets.house" />
        <Values />
        <Achievements />
        <NavigatingExperience />
        <MeetTeam :team="team" />
        <Clients :clients="clients" />
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
import { AboutAssetsInterface } from '@/Types/App/Interfaces/AboutAssetsInterface';
import { ClientInterface } from '@/Types/App/Interfaces/ClientInterface';
import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { TeamInterface } from '@/Types/App/Interfaces/TeamInterface';
import { onMounted } from 'vue';

const { errors }: { errors: ErrorInterface } = defineProps<{
    assets: AboutAssetsInterface;
    team: TeamInterface[];
    clients: ClientInterface[];
    errors: ErrorInterface;
}>();

onMounted((): void => {
    displayErrors(errors);
});
</script>
