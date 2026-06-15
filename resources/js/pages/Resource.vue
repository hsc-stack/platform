<script setup lang="ts">
import { ref, watch } from 'vue';
import { 
    FileText, 
    Image as ImageIcon, 
    Download, 
    AlertCircle,
    ArrowLeft,
    Maximize2,
    Minimize2,
    RotateCcw
} from 'lucide-vue-next';

defineProps({
    resource: {
        type: Object,
        required: true,
    },
});

const isFullscreen = ref(false);

// Zoom and Pan States
const scale = ref(1);
const translateX = ref(0);
const translateY = ref(0);
const isDragging = ref(false);

// Interaction tracking
let startX = 0;
let startY = 0;
let initialScale = 1;
let startTouchDistance = 0;

const handleBack = () => {
    if (typeof window !== 'undefined') {
        window.history.back();
    }
};

const toggleFullscreen = () => {
    isFullscreen.value = !isFullscreen.value;
    if (!isFullscreen.value) {
        resetZoom();
    }
};

const resetZoom = () => {
    scale.value = 1;
    translateX.value = 0;
    translateY.value = 0;
};

// --- Touch & Mouse Event Handlers ---

const getTouchDistance = (e: TouchEvent) => {
    return Math.hypot(
        e.touches[0].clientX - e.touches[1].clientX,
        e.touches[0].clientY - e.touches[1].clientY
    );
};

const handlePointerDown = (e: MouseEvent | TouchEvent) => {
    if ('touches' in e && e.touches.length === 2) {
        isDragging.value = false;
        initialScale = scale.value;
        startTouchDistance = getTouchDistance(e);
        return;
    }

    isDragging.value = true;
    const clientX = 'touches' in e ? e.touches[0].clientX : e.clientX;
    const clientY = 'touches' in e ? e.touches[0].clientY : e.clientY;
    
    startX = clientX - translateX.value;
    startY = clientY - translateY.value;
};

const handlePointerMove = (e: MouseEvent | TouchEvent) => {
    if ('touches' in e && e.touches.length === 2) {
        e.preventDefault();
        const currentDistance = getTouchDistance(e);
        const newScale = initialScale * (currentDistance / startTouchDistance);
        scale.value = Math.min(Math.max(newScale, 1), 5);
        return;
    }

    if (!isDragging.value || scale.value === 1) return;
    e.preventDefault();
    
    const clientX = 'touches' in e ? e.touches[0].clientX : e.clientX;
    const clientY = 'touches' in e ? e.touches[0].clientY : e.clientY;

    translateX.value = clientX - startX;
    translateY.value = clientY - startY;
};

const handlePointerUp = () => {
    isDragging.value = false;
    if (scale.value < 1) resetZoom();
};

const handleWheel = (e: WheelEvent) => {
    e.preventDefault();
    const zoomIntensity = 0.1;
    const delta = e.deltaY < 0 ? 1 : -1;
    const newScale = scale.value + delta * zoomIntensity;
    scale.value = Math.min(Math.max(newScale, 1), 5);
    
    if (scale.value === 1) resetZoom();
};

watch(isFullscreen, (val) => {
    if (typeof document !== 'undefined') {
        document.body.style.overflow = val ? 'hidden' : '';
    }
});
</script>

<template>
    <div class="mx-auto max-w-4xl px-4 pt-8 pb-20 sm:px-6 sm:pt-12 min-h-[75vh] flex flex-col justify-start">
        
        <div class="mb-6">
            <button 
                @click="handleBack" 
                class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 transition-colors hover:text-indigo-600 group"
            >
                <ArrowLeft class="h-4 w-4 transition-transform duration-200 group-hover:-translate-x-0.5" />
                Back
            </button>
        </div>

        <div class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            
            <div class="border-b border-slate-100 bg-slate-50/50 p-5 sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0">
                        <span class="inline-flex items-center gap-1.5 rounded-md bg-slate-100 px-2 py-1 text-xs font-bold uppercase tracking-wider text-slate-600">
                            <FileText v-if="resource.resource_type === 'note'" class="h-3 w-3" />
                            <ImageIcon v-else-if="resource.resource_type === 'image'" class="h-3 w-3" />
                            <Download v-else class="h-3 w-3" />
                            {{ resource.resource_type }}
                        </span>
                        <h1 class="mt-2 text-xl font-black tracking-tight text-slate-950 sm:text-2xl">
                            {{ resource.title }}
                        </h1>
                    </div>

                    <div v-if="resource.resource_type === 'image'" class="flex items-center gap-2 self-start sm:self-center">
                        <a 
                            v-if="resource.file_url"
                            :href="resource.file_url" 
                            download
                            target="_blank"
                            class="inline-flex h-9 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-xs font-bold text-slate-700 shadow-sm transition-all hover:bg-slate-50 hover:text-indigo-600 active:scale-[0.98]"
                        >
                            <Download class="h-4 w-4 stroke-[2.2]" />
                            Download
                        </a>
                        
                        <button 
                            @click="toggleFullscreen"
                            class="inline-flex h-9 items-center gap-2 rounded-xl bg-indigo-600 px-4 text-xs font-bold text-white shadow-sm transition-all hover:bg-indigo-700 active:scale-[0.98]"
                            title="View Fullscreen"
                        >
                            <Maximize2 class="h-4 w-4 stroke-[2.2]" />
                            Full Screen
                        </button>
                    </div>
                </div>
            </div>

            <div v-if="resource.resource_type === 'note'" class="p-6 sm:p-8">
                <div class="prose max-w-none text-sm font-medium leading-relaxed text-slate-700 sm:text-base">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-2">Note:</h3>
                    <p class="whitespace-pre-line selection:bg-indigo-100 selection:text-indigo-900">
                        {{ resource.content }}
                    </p>
                </div>
            </div>

            <div v-else-if="resource.resource_type === 'image'">
                <div v-if="resource.content" class="p-6 sm:p-8 bg-white border-b border-slate-100">
                    <div class="prose max-w-none text-sm font-medium leading-relaxed text-slate-700 sm:text-base">
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-2">Note:</h3>
                        <p class="whitespace-pre-line selection:bg-indigo-100 selection:text-indigo-900">
                            {{ resource.content }}
                        </p>
                    </div>
                </div>

                <div class="bg-slate-950/5 p-4 sm:p-8 flex justify-center">
                    <div class="relative overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition-shadow duration-300 hover:shadow-md">
                        <img 
                            :src="resource.file_url" 
                            :alt="resource.title" 
                            class="max-h-[70vh] w-auto object-contain select-none"
                        />
                    </div>
                </div>
            </div>

            <div v-else class="p-6 sm:p-10 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 border border-amber-200">
                    <AlertCircle class="h-6 w-6 stroke-[2.2]" />
                </div>
                
                <h3 class="mt-4 text-base font-bold text-slate-900">
                    Unsupported Preview: <span class="capitalize text-indigo-600">{{ resource.resource_type }}</span>
                </h3>
                <p class="mx-auto mt-2 max-w-sm text-xs font-medium text-slate-500 sm:text-sm">
                    The file can't be shown here. Please download.
                </p>

                <div class="mt-6 flex justify-center">
                    <a 
                        v-if="resource.file_url"
                        :href="resource.file_url" 
                        download
                        target="_blank"
                        class="inline-flex touch-manipulation items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-xs font-bold text-white shadow-sm transition-all duration-200 hover:bg-indigo-700 active:scale-[0.98]"
                    >
                        <Download class="h-4 w-4 stroke-[2.5]" />
                        Download
                    </a>
                    <div 
                        v-else 
                        class="rounded-lg border border-dashed border-slate-200 bg-slate-50 px-4 py-2 text-xs font-semibold text-slate-400"
                    >
                        No download target generated for this asset.
                    </div>
                </div>
            </div>

        </div>
    </div>

    <Teleport to="body">
        <div 
            v-if="isFullscreen" 
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/95 backdrop-blur-sm select-none touch-none"
            @wheel="handleWheel"
            @mousedown="handlePointerDown"
            @mousemove="handlePointerMove"
            @mouseup="handlePointerUp"
            @mouseleave="handlePointerUp"
            @touchstart="handlePointerDown"
            @touchmove="handlePointerMove"
            @touchend="handlePointerUp"
        >
            <div class="fixed top-4 right-4 z-50 flex items-center gap-2">
                <div class="hidden sm:flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1.5 text-[11px] font-medium text-slate-300 backdrop-blur-md">
                    <span>Pinch / Scroll to Zoom</span>
                    <span class="text-slate-500">•</span>
                    <span>Drag to Pan</span>
                </div>
                
                <button 
                    v-if="scale > 1"
                    @click="resetZoom"
                    class="p-3 rounded-full bg-white/10 text-white hover:bg-white/20 transition-all active:scale-95 backdrop-blur-md"
                    title="Reset Zoom"
                >
                    <RotateCcw class="h-5 w-5" />
                </button>

                <button 
                    @click="toggleFullscreen"
                    class="p-3 rounded-full bg-white/10 text-white hover:bg-white/20 transition-all active:scale-95 backdrop-blur-md"
                    title="Exit Fullscreen"
                >
                    <Minimize2 class="h-5 w-5" />
                </button>
            </div>

            <img 
                :src="resource.file_url" 
                :alt="resource.title" 
                class="max-h-[90vh] max-w-[90vw] object-contain pointer-events-none rounded transition-transform duration-75 ease-out shadow-2xl"
                :style="{
                    transform: `translate(${translateX}px, ${translateY}px) scale(${scale})`
                }"
            />
        </div>
    </Teleport>
</template>