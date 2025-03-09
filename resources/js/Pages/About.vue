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

<script lang="ts" setup>
import Achievements from '@/Components/About/Achievements.vue';
import Clients from '@/Components/About/Clients.vue';
import Journey from '@/Components/About/Journey.vue';
import MeetTeam from '@/Components/About/MeetTeam.vue';
import NavigatingExperience from '@/Components/About/NavigatingExperience.vue';
import Values from '@/Components/About/Values.vue';
import Layout from '@/Layouts/Layout.vue';
</script>
