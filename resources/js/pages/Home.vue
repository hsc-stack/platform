<script setup>
import { ref, computed } from 'vue';
import {
    Search,
    Atom,
    FlaskConical,
    Dna,
    Sigma,
    Laptop,
    BookOpen,
    PenTool,
    BarChart3,
} from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    subjects: Array,
});

const icons = {
    Atom,
    FlaskConical,
    Dna,
    Sigma,
    Laptop,
    BookOpen,
    PenTool,
    BarChart3,
    Search,
};
const subjects = props.subjects;
const searchQuery = ref('');

const filteredSubjects = computed(() => {
    return subjects.filter((subject) =>
        subject.name.toLowerCase().includes(searchQuery.value.toLowerCase()),
    );
});
</script>

<template>
    <header class="mx-auto max-w-3xl px-4 pt-12 pb-10 text-center sm:pt-16">
        <h1
            class="mb-4 text-4xl leading-tight font-black tracking-tight text-slate-950 sm:text-5xl"
        >
            Your knowledge, <br />
            <span class="text-indigo-600">perfectly organized.</span>
        </h1>
        <p
            class="mx-auto mb-8 max-w-md text-sm font-medium text-slate-500 sm:text-base"
        >
            Premium study materials, curated for HSC students. Fast, clean,
            and distraction-free.
        </p>

        <div class="relative mx-auto max-w-md">
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Search for a subject..."
                class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-3.5 pr-4 pl-11 text-sm font-medium shadow-sm transition-all duration-200 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 focus:outline-none"
            />
            <Search
                class="pointer-events-none absolute top-[15px] left-4 h-4 w-4 text-slate-400"
            />
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 pb-20 sm:px-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <Link
                v-for="subject in filteredSubjects"
                :key="subject.name"
                :href="subject.slug"
                class="group relative flex touch-manipulation flex-col justify-between overflow-hidden rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:border-indigo-300 hover:shadow-md active:scale-[0.98] sm:active:scale-100"
            >
                <div class="flex items-start gap-4 lg:block">
                    <div
                        :class="[
                            subject.tailwind_format,
                            'flex h-11 w-11 shrink-0 items-center justify-center rounded-xl transition-colors duration-200 lg:mb-5',
                        ]"
                    >
                        <component
                            :is="icons[subject.icon]"
                            class="h-5 w-5 stroke-[2.2]"
                        />
                    </div>

                    <div class="min-w-0">
                        <h3
                            class="truncate text-base font-bold text-slate-900 transition-colors group-hover:text-indigo-600"
                        >
                            {{ subject.name }}
                        </h3>
                        <p class="mt-0.5 text-xs font-semibold text-slate-400">
                            {{ subject.nodes_count }} Chapters
                        </p>
                    </div>
                </div>

                <div
                    class="mt-5 flex items-center justify-between border-t border-slate-100 pt-3 lg:mt-6"
                >
                    <span
                        class="text-xs font-bold text-slate-500 transition-colors group-hover:text-indigo-600"
                    >
                        View Materials
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
        </div>

        <div
            v-if="filteredSubjects.length === 0"
            class="rounded-xl border border-dashed border-slate-200 bg-white/50 py-12 text-center"
        >
            <p class="text-sm font-semibold text-slate-400">
                No subjects found matching "{{ searchQuery }}"
            </p>
            <button
                @click="searchQuery = ''"
                class="mt-2 text-xs font-bold text-indigo-600 hover:underline"
            >
                Show all subjects
            </button>
        </div>
    </main>
</template>