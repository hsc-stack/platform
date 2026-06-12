<script setup lang="ts">
import AppLogo from './AppLogo.vue';
</script>

<template>
    <nav
        class="sticky top-0 z-50 border-b border-slate-200/60 bg-white/80 backdrop-blur-md"
    >
        <div
            class="mx-auto flex h-14 max-w-7xl items-center justify-between px-4 sm:px-6"
        >
            <AppLogo />

            <div class="flex items-center gap-4">
                <a
                    href="/admin"
                    class="text-sm font-medium text-slate-600 transition-colors hover:text-slate-900"
                >
                    Admin
                </a>
            </div>
        </div>
    </nav>
</template>
