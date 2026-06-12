<script setup>
import { Shield, ArrowLeft, Eye, Lock, Cookie } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="mx-auto max-w-3xl px-4 pt-12 pb-8 text-center sm:pt-16">
        <Link 
            href="/" 
            class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors mb-4 group"
        >
            <ArrowLeft class="h-3.5 w-3.5 transition-transform group-hover:-translate-x-0.5" />
            Back to Home
        </Link>
        <h1 class="mb-4 text-4xl leading-tight font-black tracking-tight text-slate-950 sm:text-5xl">
            Privacy <span class="text-indigo-600">Policy</span>
        </h1>
        <p class="mx-auto max-w-md text-xs font-semibold text-slate-400 uppercase tracking-wider">
            Last Updated: June 2026
        </p>
    </header>

    <main class="mx-auto max-w-3xl px-4 pb-20 sm:px-6">
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 space-y-8">
            
            <p class="text-sm font-medium leading-relaxed text-slate-600">
                Welcome to our platform. We are dedicated to providing premium, curated, and distraction-free study materials for HSC students. This Privacy Policy explains how we collect, use, and protect your information when you use our website.
            </p>

            <hr class="border-slate-100" />

            <!-- Section 1 -->
            <div class="flex gap-4 items-start">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <Eye class="h-4 w-4 stroke-[2.2]" />
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">1. Information We Collect</h2>
                    <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-500">
                        We believe in keeping things fast and clean. We collect minimal information required to deliver a great experience:
                    </p>
                    <ul class="list-disc pl-5 mt-2 text-sm font-medium text-slate-500 space-y-1">
                        <li><strong class="text-slate-700">Usage Data:</strong> Non-personal data such as browser type and pages visited to optimize layout performance.</li>
                        <li><strong class="text-slate-700">Search Queries:</strong> Your search inputs are processed locally on your device to instantly filter subjects.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="flex gap-4 items-start">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <Cookie class="h-4 w-4 stroke-[2.2]" />
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">2. Cookies and Tracking</h2>
                    <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-500">
                        We use lightweight local storage or cookies to remember your visual preferences (like layout sizing or cached data) to ensure a seamless browsing session. We do not track you across other websites.
                    </p>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="flex gap-4 items-start">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <Shield class="h-4 w-4 stroke-[2.2]" />
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">3. Third-Party Services</h2>
                    <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-500">
                        Our archive utilizes modern hosting platforms and lightweight analytics tools to remain online and perform quickly. These third parties handle your basic operational data safely and strictly under security compliance rules.
                    </p>
                </div>
            </div>

            <!-- Section 4 -->
            <div class="flex gap-4 items-start">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <Lock class="h-4 w-4 stroke-[2.2]" />
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">4. Data Security</h2>
                    <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-500">
                        We implement strict, clean codebase practices to ensure platform safety. While we maximize efforts to secure this digital archive, remember that absolute network security does not exist online.
                    </p>
                </div>
            </div>

        </div>
    </main>
</template>