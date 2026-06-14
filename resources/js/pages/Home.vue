<script setup>
import { ref, computed } from 'vue';
import SubjectCard from '@/components/SubjectCard.vue';
import RepositoryStas from '@/components/RepositoryStas.vue';
import HomeHeader from '@/components/HomeHeader.vue';
import Resource from './Resource.vue';

const props = defineProps({
    subjects: Array,
    subjectCount : Number,
    resourceCount : Number,
    siteTraffic : Number,
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
    <HomeHeader v-model="searchQuery" />

    <main class="mx-auto max-w-7xl px-4 pb-20 sm:px-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <SubjectCard
                v-for="subject in filteredSubjects"
                :key="subject.id"
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

    <RepositoryStas
        :total-subjects="subjectCount"
        :total-resources="resourceCount"
        :total-traffic="siteTraffic"
    />
</template>
