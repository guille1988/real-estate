<template>
    <div class="flex min-h-screen flex-col bg-gray-900 text-white">
        <Navbar />
        <slot />
        <Footer />
    </div>
</template>

<script lang="ts" setup>
import Footer from '@/Components/Layouts/Footer/Footer.vue';
import Navbar from '@/Components/Layouts/Navbar.vue';
</script>
