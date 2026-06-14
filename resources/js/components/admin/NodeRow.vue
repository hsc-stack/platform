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
        class="group relative flex flex-col items-center justify-center rounded-xl border border-transparent p-2 text-center transition-all duration-200 hover:border-indigo-100/60 hover:bg-slate-50/60 hover:shadow-sm active:scale-95"
    >
        <div 
            class="absolute right-1 top-1 z-10 opacity-0 transition-opacity duration-150 group-hover:opacity-100"
            @click.stop
        >
            <Link
                :href="`/admin/subjects/${node.subject_id}/nodes/edit/${node.id}`"
                class="inline-flex h-5 items-center gap-1 rounded-md border border-slate-200 bg-white px-1.5 py-0.5 text-[10px] font-medium text-slate-500 shadow-sm transition-colors hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
                title="Edit Node"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="h-2.5 w-2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
                <span>Edit</span>
            </Link>
        </div>

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