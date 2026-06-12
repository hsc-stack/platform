<script setup>
import { Scale, ArrowLeft, FileText, HelpCircle, AlertCircle } from 'lucide-vue-next';
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
            Terms & <span class="text-indigo-600">Conditions</span>
        </h1>
        <p class="mx-auto max-w-md text-xs font-semibold text-slate-400 uppercase tracking-wider">
            Last Updated: June 2026
        </p>
    </header>

    <main class="mx-auto max-w-3xl px-4 pb-20 sm:px-6">
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 space-y-8">
            
            <p class="text-sm font-medium leading-relaxed text-slate-600">
                By accessing or browsing this archive, you agree to comply with and be bound by the following Terms & Conditions. If you disagree with any part of these rules, please refrain from using our educational directory.
            </p>

            <hr class="border-slate-100" />

            <!-- Section 1 -->
            <div class="flex gap-4 items-start">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <FileText class="h-4 w-4 stroke-[2.2]" />
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">1. Description of Service</h2>
                    <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-500">
                        This platform functions as a fast, distraction-free study archive for HSC students. We host:
                    </p>
                    <ul class="list-disc pl-5 mt-2 text-sm font-medium text-slate-500 space-y-1">
                        <li>Personally handwritten notes, practical records, and structural guides.</li>
                        <li>Syllabus-aligned publicly available content.</li>
                        <li>Historical public question banks from past examination cycles.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="flex gap-4 items-start">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <Scale class="h-4 w-4 stroke-[2.2]" />
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">2. Intellectual Property & Fair Use</h2>
                    <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-500">
                        Our original text layouts, system scripts, and written notes are owned by us. Students are granted access for private study use. Official state board evaluation questions or public question structures are shared entirely under <strong class="text-slate-700">Fair Use principles</strong> for clear educational backup. We claim no dynamic entity rights over official board items. Bulk scraping or reselling platform data is strictly forbidden.
                    </p>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="flex gap-4 items-start">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <HelpCircle class="h-4 w-4 stroke-[2.2]" />
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">3. Educational Accuracy Disclaimer</h2>
                    <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-500">
                        While we aim for clean curation and accuracy, everything is shared on an "as-is" basis. We offer no performance warranties, and users should compare data streams alongside official HSC college textbooks to maintain accurate learning parameters.
                    </p>
                </div>
            </div>

            <!-- Section 4 -->
            <div class="flex gap-4 items-start">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <AlertCircle class="h-4 w-4 stroke-[2.2]" />
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900">4. Limitation of Liability</h2>
                    <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-500">
                        Our platform and development maintainers shall not face legal liability for any internal data outages, grading discrepancies, or contextual errors stemming directly or indirectly from using the archival content.
                    </p>
                </div>
            </div>

        </div>
    </main>
</template>