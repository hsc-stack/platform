<script setup>
import { ref, computed } from 'vue';
import SubjectCard from '@/components/SubjectCard.vue';

const props = defineProps({
    subjects: Array,
});

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
            A clean, fast resource repository for HSC students in Bangladesh.
            Browse notes, practicals, and past papers organized by subject and
            chapter.
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
            <SubjectCard
                v-for="subject in filteredSubjects"
                :key="subject.name"
                :subject="subject"
            />
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
