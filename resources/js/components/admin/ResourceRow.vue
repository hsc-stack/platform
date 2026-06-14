<script setup>
import { Link } from '@inertiajs/vue3';
import { Book, File, FileArchive, FileImage, FileVideo } from 'lucide-vue-next';

const { resource } = defineProps({
    resource: Object,
});
</script>

<template>
    <Link
        :href="`/resources/${resource.id}`"
        target="_blank"
        class="group relative flex flex-col items-center justify-center rounded-xl border border-transparent p-2 text-center transition-all duration-200 hover:border-amber-100/60 hover:bg-amber-50/30 hover:shadow-sm active:scale-95"
    >
        <div 
            class="absolute right-1 top-1 z-10 opacity-0 transition-opacity duration-150 group-hover:opacity-100"
            @click.stop
        >
            <Link
                :href="`/admin/resources/edit/${resource.id}`"
                target="_self"
                class="inline-flex h-5 items-center gap-1 rounded-md border border-slate-200 bg-white px-1.5 py-0.5 text-[10px] font-medium text-slate-500 shadow-sm transition-colors hover:border-amber-200 hover:bg-amber-50 hover:text-amber-700"
                title="Edit Resource"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="h-2.5 w-2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
                <span>Edit</span>
            </Link>
        </div>

        <div
            class="mb-2 flex h-14 w-14 shrink-0 items-center justify-center rounded-xl border border-amber-200/40 bg-amber-50 text-amber-600 transition-colors duration-200 group-hover:border-amber-200 group-hover:bg-amber-100/70 group-hover:text-amber-700"
        >
            <FileImage
                v-if="resource.resource_type === 'image'"
                class="h-6 w-6 stroke-[2.2]"
            />
            <FileVideo
                v-else-if="resource.resource_type === 'video'"
                class="h-6 w-6 stroke-[2.2]"
            />
            <FileArchive
                v-else-if="resource.resource_type === 'pdf'"
                class="h-6 w-6 stroke-[2.2]"
            />
            <Book
                v-else-if="resource.resource_type === 'text'"
                class="h-6 w-6 stroke-[2.2]"
            />
            <File v-else class="h-6 w-6 stroke-[2.2]" />
        </div>

        <div class="w-full max-w-[100px] px-0.5">
            <span
                class="block truncate text-xs font-bold text-slate-900 transition-colors group-hover:text-amber-700"
                :title="resource.title"
            >
                {{ resource.title }}
            </span>
        </div>
    </Link>
</template>

<style scoped></style>