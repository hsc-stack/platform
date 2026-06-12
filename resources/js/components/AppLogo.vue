<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link href="/" class="flex items-center gap-2.5">
        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-900 shadow-sm">
            <svg
                viewBox="0 0 24 24"
                class="h-4 w-4 text-white"
                fill="none"
                stroke="currentColor"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg>
        </div>
        <span class="text-lg font-extrabold tracking-tight text-slate-900">
            HSC<span class="text-indigo-600">Stack</span>
        </span>
    </Link>
</template>