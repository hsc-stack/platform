<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
    Home as HomeIcon,
    ChevronRight as ChevronRightIcon,
    Folder as FolderIcon,
    FileImage as ImageIcon,
    File as GenericFileIcon,
} from 'lucide-vue-next';

const props = defineProps({
    subject: Object,
    nodes: Array,
    breadcrumb: Array,
    resources: Array ,
});


const breadcrumbs = computed(() => {
    const subjectPath = props.subject?.slug ? `/${props.subject.slug}` : '';
    let path = '';

    return (props.breadcrumb || []).map((crumb) => {
        path += `/${crumb.slug}`;

        return {
            name: crumb.name,
            link: `${subjectPath}${path}`,
        };
    });
});

const totalItemsCount = computed(() => {
    const nodesCount = props.nodes?.length || 0;
    const resourcesCount = props.resources.length;
    return nodesCount + resourcesCount;
});


</script>

<template>
    <div
        class="mx-auto flex min-h-[calc(100vh-10rem)] w-full max-w-4xl flex-col px-4 py-8 font-sans text-slate-700 selection:bg-indigo-50 sm:px-6 md:py-12"
    >
        <nav
            class="no-scrollbar mb-6 flex items-center space-x-2 overflow-x-auto text-xs font-semibold tracking-wider whitespace-nowrap text-slate-400 uppercase"
        >
            <Link
                href="/"
                class="mr-0.5 flex items-center rounded-lg p-1 transition-colors hover:bg-slate-100/80 hover:text-indigo-600"
            >
                <HomeIcon class="h-4 w-4 stroke-[2.2]" />
            </Link>

            <ChevronRightIcon
                class="h-3.5 w-3.5 shrink-0 stroke-[2.5] text-slate-300"
            />

            <Link
                :href="`/${props.subject?.slug || ''}`"
                class="px-1 whitespace-nowrap transition-colors hover:text-indigo-600"
            >
                {{ props.subject?.name }}
            </Link>

            <template
                v-for="(crumb, index) in breadcrumbs"
                :key="`${crumb.name}-${index}`"
            >
                <ChevronRightIcon
                    class="h-3.5 w-3.5 shrink-0 stroke-[2.5] text-slate-300"
                />

                <Link
                    :href="crumb.link"
                    class="px-1 whitespace-nowrap transition-colors hover:text-indigo-600"
                >
                    {{ crumb.name }}
                </Link>
            </template>
        </nav>

        <header class="mb-8">
            <h1
                class="text-3xl font-black tracking-tight text-slate-950 sm:text-4xl"
            >
                {{ props.subject?.name }}
            </h1>
            <p class="mt-1.5 text-sm font-semibold text-slate-400">
                {{ totalItemsCount }} Items Total
            </p>
        </header>

        <div
            class="flex flex-1 flex-col overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm"
        >
            <div
                class="flex items-center justify-between border-b border-slate-100 bg-slate-50 px-5 py-3.5 text-xs font-bold tracking-wider text-slate-400 uppercase sm:px-6"
            >
                <span>Name</span>
                <span class="hidden sm:inline">Type</span>
            </div>

            <div class="flex-1 divide-y divide-slate-100">
                <template v-if="totalItemsCount > 0">
                    <Link
                        v-for="node in props.nodes"
                        :key="`node-${node.id}`"
                        :href="`${$page.url}/${node.slug}`"
                        class="group relative flex cursor-pointer touch-manipulation items-center justify-between bg-white px-5 py-4.5 transition-all duration-200 hover:bg-slate-50/40 active:scale-[0.995] sm:px-6 sm:active:scale-100"
                    >
                        <div class="flex min-w-0 items-center gap-4">
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-slate-200/40 bg-slate-100 text-slate-500 transition-colors duration-200 group-hover:border-indigo-100 group-hover:bg-indigo-50 group-hover:text-indigo-600"
                            >
                                <FolderIcon class="h-5 w-5 stroke-[2.2]" />
                            </div>

                            <div class="min-w-0">
                                <span
                                    class="block truncate text-base font-bold text-slate-900 transition-colors group-hover:text-indigo-600"
                                >
                                    {{ node.name }}
                                </span>
                                <span
                                    class="mt-0.5 inline-block text-xs font-semibold text-slate-400 sm:hidden"
                                >
                                    {{ node.children_count + node.resources_count || 0 }} Materials
                                </span>
                            </div>
                        </div>

                        <div class="flex shrink-0 items-center gap-4 pl-3">
                            <span
                                class="hidden rounded-md border border-slate-200/60 bg-slate-50 px-2.5 py-1 text-xs font-bold text-slate-500 transition-colors group-hover:border-indigo-100/80 group-hover:bg-indigo-50/60 group-hover:text-indigo-600 sm:inline-block"
                            >
                                    {{ node.children_count + node.resources_count || 0 }} Materials
                            </span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-indigo-600"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                    </Link>

                    <Link
                        v-for="resource in resources"
                        :key="`resource-${resource.id}`"
                        :href="`/resources/${resource.id}`"
                        target="_blank"
                        class="group relative flex cursor-pointer touch-manipulation items-center justify-between bg-white px-5 py-4.5 transition-all duration-200 hover:bg-slate-50/40 active:scale-[0.995] sm:px-6 sm:active:scale-100"
                    >
                        <div class="flex min-w-0 items-center gap-4">
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-amber-200/40 bg-amber-50 text-amber-600 transition-colors duration-200 group-hover:border-amber-200 group-hover:bg-amber-100/70"
                            >
                                <ImageIcon
                                    v-if="
                                        resource.resource_type == 'image'
                                    "
                                    class="h-5 w-5 stroke-[2.2]"
                                />
                                <GenericFileIcon
                                    v-else
                                    class="h-5 w-5 stroke-[2.2]"
                                />
                            </div>

                            <div class="min-w-0">
                                <span
                                    class="block truncate text-base font-bold text-slate-900 transition-colors group-hover:text-amber-700"
                                >
                                    {{ resource.title }}
                                </span>
                                <span
                                    class="mt-0.5 inline-block text-xs font-semibold text-amber-600 sm:hidden"
                                >
                                    {{ resource.resource_type }}
                                </span>
                            </div>
                        </div>

                        <div class="flex shrink-0 items-center gap-4 pl-3">
                            <span
                                class="hidden rounded-md border border-amber-200/60 bg-amber-50/60 px-2.5 py-1 text-xs font-bold text-amber-600 sm:inline-block"
                            >
                                {{ resource.resource_type }}
                            </span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 group-hover:text-amber-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                />
                            </svg>
                        </div>
                    </Link>
                </template>

                <div
                    v-else
                    class="flex flex-col items-center justify-center px-4 py-14 text-center"
                >
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50 text-slate-400"
                    >
                        <FolderIcon class="h-6 w-6 stroke-[1.8]" />
                    </div>
                    <h3 class="mt-4 text-sm font-bold text-slate-900">
                        No items available
                    </h3>
                    <p
                        class="mt-1 max-w-xs text-xs leading-relaxed font-medium text-slate-400"
                    >
                        There are currently no files or sub-folders located
                        inside this section.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
