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
        class="group flex flex-col items-center justify-center rounded-xl border border-transparent p-2 text-center transition-all duration-200 hover:border-amber-100/60 hover:bg-amber-50/30 hover:shadow-sm active:scale-95"
    >
        <!-- Enlarged Amber-Themed Icon Container -->
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

        <!-- File Title Layout -->
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