<template>
    <div class="min-h-screen bg-gray-900 text-white">
        <Navbar></Navbar>
        <slot></slot>
        <Footer></Footer>
    </div>
</template>

<script lang="ts" setup>
import Footer from '@/Components/Layouts/Footer.vue';
import Navbar from '@/Components/Layouts/Navbar.vue';
</script>
