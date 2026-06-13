<script setup>
import { Link } from '@inertiajs/vue3';
import { Folder } from 'lucide-vue-next';

const { node } = defineProps({
    node: Object,
});
</script>

<template>
    <Link
        :href="`${$page.url}/${node.slug}`"
        class="group flex flex-col items-center justify-center rounded-xl border border-transparent p-2 text-center transition-all duration-200 hover:border-indigo-100/60 hover:bg-slate-50/60 hover:shadow-sm active:scale-95"
    >
        <div
            class="mb-2 flex h-14 w-14 shrink-0 items-center justify-center rounded-xl border border-slate-200/40 bg-slate-100 text-slate-500 transition-colors duration-200 group-hover:border-indigo-100 group-hover:bg-indigo-50 group-hover:text-indigo-600"
        >
            <Folder class="h-6.5 w-6.5 stroke-[2.2]" />
        </div>

        <div class="w-full max-w-[100px] px-0.5">
            <span
                class="block truncate text-xs font-bold text-slate-900 transition-colors group-hover:text-indigo-600"
                :title="node.name"
            >
                {{ node.name }}
            </span>
        </div>
    </Link>
</template>

<style scoped></style>