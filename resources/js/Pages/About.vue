<template>
    <Layout>
        <JourneySection></JourneySection>
        <ValuesSection></ValuesSection>
        <AchievementsSection></AchievementsSection>
    </Layout>
</template>

<script lang="ts" setup>
import AchievementsSection from '@/Components/About/AchievementsSection.vue';
import JourneySection from '@/Components/About/JourneySection.vue';
import ValuesSection from '@/Components/About/ValuesSection.vue';
import Layout from '@/Layouts/Layout.vue';
</script>
