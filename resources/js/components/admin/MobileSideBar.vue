<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { X, LogOut, Database } from 'lucide-vue-next';

defineProps({
    navigation: Array,
    isOpen: Boolean,
});

defineEmits(['close', 'logout']);
</script>

<template>
    <div v-if="isOpen" class="fixed inset-0 z-50 flex md:hidden">
        <div
            class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm"
            @click="$emit('close')"
        ></div>

        <div
            class="relative flex w-full max-w-xs flex-1 flex-col justify-between border-r border-slate-200 bg-white/90 p-5 shadow-2xl backdrop-blur-xl"
        >
            <div>
                <div class="mb-6 flex items-center justify-between">
                    <p
                        class="text-xs font-semibold tracking-wider text-slate-400 uppercase"
                    >
                        Navigation
                    </p>
                    <button
                        @click="$emit('close')"
                        class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100"
                    >
                        <X class="h-5 w-5" />
                    </button>
                </div>

                <nav class="space-y-1">
                    <div v-for="(item, index) in navigation" :key="item.name">
                        <Link
                            :href="item.to"
                            @click="$emit('close')"
                            class="group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50/60 hover:text-indigo-600"
                        >
                            <component :is="item.icon" class="h-4 w-4" />
                            <span>{{ item.name }}</span>
                        </Link>

                        <hr
                            v-if="index < navigation.length - 1"
                            class="mx-3 my-1 border-slate-200/60"
                        />
                    </div>
                </nav>
            </div>

            <div class="space-y-3">
                <Link
                    method="post"
                    href="/admin/clear-cache"
                    as="button"
                    class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50/60"
                >
                    <Database class="h-4 w-4" />
                    Clear Cache
                </Link>
                <Link
                    method="post"
                    href="/logout"
                    as="button"
                    class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-rose-600 hover:bg-rose-50/60"
                >
                    <LogOut class="h-4 w-4" />
                    Logout
                </Link>

                <div
                    class="border-t border-slate-200/60 px-2 pt-3 text-xs text-slate-400"
                >
                    Internal Dashboard
                </div>
            </div>
        </div>
    </div>
</template>
