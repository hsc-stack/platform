<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Folder, Pencil } from 'lucide-vue-next';

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
            class="absolute top-1 right-1 z-10 opacity-100 transition-opacity duration-150 md:opacity-0 md:group-hover:opacity-100"
            @click.stop
        >
            <Link
                :href="`/admin/subjects/${node.subject_id}/nodes/edit/${node.id}`"
                class="inline-flex h-5 items-center gap-1 rounded-md border border-slate-200 bg-white px-1.5 py-0.5 text-[10px] font-medium text-slate-500 shadow-sm transition-colors hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
                title="Edit Node"
            >
                <Pencil class="h-2.5 w-2.5" :stroke-width="2.2" />
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