<script setup>
import { ref } from 'vue';
import { Search } from 'lucide-vue-next';
import Footer from '@/components/Footer.vue';
import NavBar from '@/components/NavBar.vue';

// Shared or global layout state can go here if needed
const searchQuery = ref('');
</script>

<template>
    <div
        class="min-h-screen bg-[#FAFAFB] font-sans text-slate-900 antialiased selection:bg-indigo-600 selection:text-white"
    >
        <div
            class="pointer-events-none fixed inset-0 -z-10 overflow-hidden opacity-70"
        >
            <div
                class="absolute -top-[10%] -left-[10%] h-[400px] w-[400px] rounded-full bg-indigo-100/60 blur-[100px]"
            ></div>
            <div
                class="absolute top-[30%] -right-[10%] h-[350px] w-[350px] rounded-full bg-blue-100/50 blur-[90px]"
            ></div>
        </div>


        <NavBar/>

        <slot />

        <Footer/>

    </div>
</template>