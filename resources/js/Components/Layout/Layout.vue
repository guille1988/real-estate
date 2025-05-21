<template>
    <div class="min-h-screen bg-gray-900 text-white">
        <Navbar></Navbar>
        <slot></slot>
        <Footer></Footer>
    </div>
</template>

<script lang="ts" setup>
import Footer from '@/Components/Layout/Footer/Footer.vue';
import Navbar from '@/Components/Layout/Navbar.vue';
</script>
