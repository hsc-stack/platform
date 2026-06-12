<script setup>
import {
    ArrowLeft,
    Github,
    Facebook,
} from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

const team = [
    {
        name: 'TR Tajim',
        role: 'Lead Maintainer & Developer',
        college: 'Rangpur Zilla School',
        bio: 'Building distraction-free, open-source infrastructure tailored for advanced HSC prep environments.',
        image: 'https://static.vecteezy.com/system/resources/previews/005/544/718/non_2x/profile-icon-design-free-vector.jpg',
        github: 'https://github.com/trtajim',
        facebook: 'https://facebook.com/trtajim',
    },
    {
        name: 'Ahnaf Saikat',
        role: 'Resource Curator',
        college: 'Rangpur Zilla School',
        bio: 'Sourcing flawless board questions and cross-checking handwritten notes for formula precision.',
        image: 'https://static.vecteezy.com/system/resources/previews/005/544/718/non_2x/profile-icon-design-free-vector.jpg',
        github: '#',
        facebook: '#',
    }
];
</script>

<template>
    <!-- Header -->
    <header class="mx-auto max-w-4xl px-4 pt-16 pb-14 text-center sm:pt-20">
        <Link
            href="/"
            class="group mb-5 inline-flex items-center gap-2 text-xs font-bold text-slate-400 transition-colors hover:text-indigo-600"
        >
            <ArrowLeft class="h-3.5 w-3.5 transition-transform group-hover:-translate-x-0.5" />
            Back to Home
        </Link>
        <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-slate-950">
            The Team Behind <br class="hidden sm:inline" />
            <span class="text-indigo-600">The Archive.</span>
        </h1>
    </header>

    <!-- Main Content Focus: Expanded Clean Team Layout -->
    <main class="mx-auto max-w-6xl px-4 pb-32 sm:px-6">
        <!-- Increased gap from gap-4 to gap-8 for deliberate structural breathing room -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 justify-center">
            
            <div
                v-for="member in team"
                :key="member.name"
                class="group flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-8 text-center transition-all duration-300 hover:border-slate-300 hover:shadow-md hover:shadow-slate-100/50"
            >
                <div class="flex flex-col items-center">
                    <!-- Prominent, Massive Custom Profile Image Base -->
                    <div class="mb-6">
                        <img 
                            v-if="member.image"
                            :src="member.image" 
                            :alt="member.name"
                            class="h-28 w-28 rounded-3xl border border-slate-100 object-cover shadow-sm transition-transform duration-300 group-hover:scale-[1.03]"
                        />
                        <div 
                            v-else
                            class="flex h-28 w-28 items-center justify-center rounded-3xl border border-indigo-100 bg-indigo-50 text-2xl font-black text-indigo-600 shadow-sm"
                        >
                            {{ member.name.split(' ').map((n) => n[0]).join('') }}
                        </div>
                    </div>

                    <!-- Clean, Uncluttered Typography Hierarchy -->
                    <div class="space-y-1">
                        <h3 class="text-xl font-black tracking-tight text-slate-950">
                            {{ member.name }}
                        </h3>
                        <p class="text-xs font-bold tracking-wide uppercase text-indigo-600">
                            {{ member.role }}
                        </p>
                        <p class="text-xs font-semibold text-slate-400">
                            {{ member.college }}
                        </p>
                    </div>

                    <p class="mt-5 text-sm font-medium leading-relaxed text-slate-600 max-w-xs">
                        {{ member.bio }}
                    </p>
                </div>

                <!-- Simple, bold utility triggers for handles -->
                <div class="mt-8 flex items-center justify-center gap-6 border-t border-slate-100 pt-5">
                    <a
                        v-if="member.github"
                        :href="member.github"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 transition-colors hover:text-slate-950"
                    >
                        <Github class="h-4 w-4" />
                        GitHub
                    </a>
                    <span v-if="member.github && member.facebook" class="h-3.5 w-px bg-slate-200"></span>
                    <a
                        v-if="member.facebook"
                        :href="member.facebook"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 transition-colors hover:text-indigo-600"
                    >
                        <Facebook class="h-4 w-4" />
                        Connect
                    </a>
                </div>
            </div>

            <!-- Join Us Static Card Interface inside Grid Layout -->
            <div class="flex flex-col justify-between rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/40 p-8 text-center">
                <div class="my-auto py-8 space-y-3">
                    <h3 class="text-lg font-extrabold text-slate-900">Want your card here?</h3>
                    <p class="text-xs font-medium leading-relaxed text-slate-400 max-w-xs mx-auto">
                        We are currently looking for active Campus Promoters, Core Developers, and Resource Curators across colleges nationwide.
                    </p>
                </div>
                <Link
                    href="/join"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-slate-950 px-4 py-3 text-xs font-bold text-white shadow-sm transition-all hover:bg-slate-900 active:scale-[0.98]"
                >
                    Apply for a Role
                </Link>
            </div>

        </div>
    </main>
</template>