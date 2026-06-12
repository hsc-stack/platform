<script setup>
import { ref, computed } from 'vue';
import { 
    ArrowLeft, 
    Megaphone, 
    FolderHeart, 
    Code2, 
    MessageSquareShare,
    Award
} from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

const roles = [
    {
        id: 'promoter',
        title: 'Campus Promoter',
        description: 'Expand our grassroots reach. Drive community awareness across student groups, share new archive updates, and represent us at your college.',
        icon: Megaphone,
        iconContainer: 'bg-emerald-50 text-emerald-600',
    },
    {
        id: 'curator',
        title: 'Resource Curator',
        description: 'Gather and organize high-yield materials. Collect pristine board question sets, scan flawless practical records, and structure chapter data templates.',
        icon: FolderHeart,
        iconContainer: 'bg-amber-50 text-amber-700',
    },
    {
        id: 'developer',
        title: 'Core Developer',
        description: 'Optimize our platform architecture, design hyper-clean frontend components, refine layout eye comfort, and ship repository features.',
        icon: Code2,
        iconContainer: 'bg-purple-50 text-purple-600',
    }
];

const selectedRole = ref('promoter');

const currentRoleTitle = computed(() => {
    return roles.find(r => r.id === selectedRole.value)?.title || 'Team Member';
});
</script>

<template>
    <!-- Header -->
    <header class="mx-auto max-w-3xl px-4 pt-12 pb-10 text-center sm:pt-16">
        <Link 
            href="/" 
            class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors mb-4 group"
        >
            <ArrowLeft class="h-3.5 w-3.5 transition-transform group-hover:-translate-x-0.5" />
            Back to Home
        </Link>
        <h1 class="mb-4 text-4xl leading-tight font-black tracking-tight text-slate-950 sm:text-5xl">
            Build the ultimate archive, <br />
            <span class="text-indigo-600">together.</span>
        </h1>
        <p class="mx-auto mb-4 max-w-md text-sm font-medium text-slate-500 sm:text-base">
            Help us scale premium, distraction-free educational engineering to HSC students nationwide. Pick a role below to jump in.
        </p>
    </header>

    <main class="mx-auto max-w-6xl px-4 pb-20 sm:px-6">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
            
            <!-- Roles Selector Grid Left -->
            <div class="space-y-4 lg:col-span-3">
                <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">
                    Open Roles
                </h2>
                
                <div 
                    v-for="role in roles" 
                    :key="role.id"
                    @click="selectedRole = role.id"
                    :class="[
                        selectedRole === role.id 
                            ? 'border-indigo-500 ring-4 ring-indigo-500/5 bg-indigo-50/10' 
                            : 'border-slate-200 bg-white hover:border-slate-300',
                        'relative flex cursor-pointer touch-manipulation gap-4 rounded-xl border p-5 transition-all duration-200 active:scale-[0.99] sm:active:scale-100'
                    ]"
                >
                    <div :class="[role.iconContainer, 'flex h-11 w-11 shrink-0 items-center justify-center rounded-xl']">
                        <component :is="role.icon" class="h-5 w-5 stroke-[2.2]" />
                    </div>
                    
                    <div class="min-w-0 pr-4">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-base font-bold text-slate-900">
                                {{ role.title }}
                            </h3>
                            <span v-if="selectedRole === role.id" class="inline-flex items-center rounded-md px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-indigo-50 text-indigo-700 border border-indigo-100">
                                Selected
                            </span>
                        </div>
                        <p class="mt-1 text-sm font-medium leading-relaxed text-slate-500">
                            {{ role.description }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contextual CTA Right Panel -->
            <div class="lg:col-span-2">
                <div class="sticky top-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6 space-y-5">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 mb-1">
                            How to Apply
                        </h2>
                        <p class="text-xs font-medium text-slate-400">
                            Let's skip the rigid forms. Drop a direct message with your background or interest to connect instantly.
                        </p>
                    </div>

                    <!-- Recognition Benefit Box -->
                    <div class="rounded-xl border border-indigo-100 bg-indigo-50/30 p-4 flex gap-3.5 items-start">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                            <Award class="h-4 w-4 stroke-[2.2]" />
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">About Us Recognition</h4>
                            <p class="mt-1 text-xs font-medium leading-relaxed text-slate-500">
                                Approved team promoters, curators, and core devs will get an official, dedicated profile card listed permanently on our upcoming <strong class="text-slate-800">About Us</strong> page, acknowledging your structural impact.
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-2">
                        <p class="text-xs font-semibold text-slate-400 mb-3">
                            Ready to pitch for <span class="text-indigo-600 font-bold">{{ currentRoleTitle }}</span>?
                        </p>
                        
                        <a 
                            href="https://facebook.com/trtajim" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-sm transition-all hover:bg-indigo-700 active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-indigo-500/20"
                        >
                            <MessageSquareShare class="h-4 w-4" />
                            Message on Facebook
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>
</template>