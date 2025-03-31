<template>
    <Layout>
        <Journey></Journey>
        <Values></Values>
        <Achievements></Achievements>
        <NavigatingExperience></NavigatingExperience>
        <MeetTeam></MeetTeam>
        <Clients></Clients>
    </Layout>
</template>

<script setup lang="ts">
import Achievements from '@/Components/About/Achievements/Achievements.vue';
import Clients from '@/Components/About/Clients/Clients.vue';
import Journey from '@/Components/About/Journey/Journey.vue';
import MeetTeam from '@/Components/About/MeetTeam/MeetTeam.vue';
import NavigatingExperience from '@/Components/About/NavigatingExperience.vue';
import Values from '@/Components/About/Values.vue';
import Layout from '@/Components/Layout/Layout.vue';
</script>
