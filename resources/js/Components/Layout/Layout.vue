<template>
    <div class="flex min-h-screen flex-col bg-gray-900 text-white">
        <Navbar></Navbar>
        <div class="flex-grow">
            <slot></slot>
        </div>
        <Footer></Footer>
    </div>
</template>

<script lang="ts" setup>
import Footer from '@/Components/Layout/Footer/Footer.vue';
import Navbar from '@/Components/Layout/Navbar/Navbar.vue';
</script>
