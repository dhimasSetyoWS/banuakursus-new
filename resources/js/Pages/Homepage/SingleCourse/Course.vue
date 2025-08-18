<template>
    <Layout title="Kursus" :canLogin="canLogin" :canRegister="canRegister">
        <main class="container mx-auto px-6 py-8 md:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-12">

                <div class="lg:col-span-2 mb-8 lg:mb-0">

                    <div class="mb-6">
                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full mb-2">Marketing</span>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">{{
                            course.title_course }}</h1>
                        <div class="mt-4 flex items-center gap-4 text-sm">
                            <div class="flex items-center gap-2">
                                <img src="https://i.pravatar.cc/150?img=12" class="w-8 h-8 rounded-full"
                                    alt="Budi Santoso">
                                <span class="font-medium">Oleh {{ creator }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-yellow-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <span class="font-bold text-slate-700">4.9</span>
                                <span class="text-slate-500">(1,250 ulasan)</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:hidden mb-8">
                        <div class="bg-white rounded-lg border border-slate-200 shadow-lg overflow-hidden">
                            <img src="https://placehold.co/600x340/6366f1/ffffff?text=Video+Kursus"
                                alt="Course thumbnail" class="w-full object-cover">
                            <div class="p-6">
                                <h2 class="text-3xl font-bold text-slate-900 mb-4">{{ formatPrice(course.price) }}</h2>
                                <button v-if="!isRegister"
                                    class="w-full py-3 px-5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                    Daftar Kursus Sekarang
                                </button>
                                <button v-else @click="lanjut"
                                    class="w-full py-3 px-5 text-gray-600 border-2 border-indigo-600 font-semibold rounded-lg hover:scale-105 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">Lanjut
                                    Belajar</button>
                                <ul class="mt-4 space-y-2 text-sm text-slate-600">
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg> 20 Jam Video On-demand</li>
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg> 32 Artikel & Materi</li>
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg> Materi Dapat Diunduh</li>
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                        </svg> Akses Selamanya</li>
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 18.75h-9a9 9 0 1 0 9 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 12.75a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 15.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                        </svg> Sertifikat Kelulusan</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-slate-900 mb-4">Deskripsi Kursus</h2>
                        <div class="space-y-4 text-slate-600 prose" v-html="course.description">
                        </div>
                    </div>

                    <!-- Session Course -->
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 mb-4">Session Kursus</h2>
                        <div class="space-y-3">
                            <div v-if="sessions.length" class="border border-slate-200 rounded-lg" v-for="data, index in sessions"
                                :key="data.id">
                                <div class="flex items-center justify-between bg-slate-50 p-3">
                                    <div class="flex items-center gap-3">
                                        <button type="button" @click="toggleAccordion(index + 1)"
                                            class="p-1.5 rounded-md hover:bg-slate-200">
                                            <svg class="w-5 h-5 text-slate-500 transition-transform duration-300"
                                                :class="{ 'rotate-90': openAccordionId === index + 1 }"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        <div>
                                            <span class="font-semibold text-sm">{{ data.session_name }}</span>
                                            <span
                                                class="ml-2 px-2 py-0.5 text-xs font-medium text-green-700 bg-green-100 rounded-full">Sesi
                                                {{ index + 1 }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <ButtonEdit />
                                        <ButtonDelete />
                                    </div>
                                </div>
                                <div class="px-3 accordion-content" :class="{ 'open': openAccordionId === index + 1 }">
                                    <div class="border-t border-slate-200 space-y-2 pt-3">
                                        <div
                                            class="flex items-center justify-between text-sm p-2 rounded-md hover:bg-slate-50">
                                            <span class="text-slate-600">Materi : </span>
                                            <div class="flex items-center gap-2">
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-between text-sm p-2 rounded-md hover:bg-slate-50">
                                            <span class="text-slate-600">Kuis : </span>
                                            <span class="text-xs text-slate-400"></span>
                                        </div>
                                        <div
                                            class="flex items-center justify-between text-sm p-2 rounded-md hover:bg-slate-50">
                                            <span class="text-slate-600">Tugas : </span>
                                            <span class="text-xs text-slate-400"></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div v-else class="font-semibold text-sm bg-slate-50 p-3 rounded-lg border border-slate-200">Tidak
                                ada
                                sesi saat ini.</div>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="lg:sticky top-24">
                        <div class="bg-white rounded-lg border border-slate-200 shadow-lg overflow-hidden">
                            <img src="https://placehold.co/600x340/6366f1/ffffff?text=Video+Kursus"
                                alt="Course thumbnail" class="w-full object-cover">
                            <div class="p-6">
                                <h2 class="text-3xl font-bold text-slate-900 mb-4">{{ formatPrice(course.price) }}</h2>
                                <button v-if="!isRegister" @click="daftar"
                                    class="w-full py-3 px-5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                                    Daftar Kursus Sekarang
                                </button>
                                <button v-else @click="lanjut"
                                    class="w-full py-3 px-5 text-gray-600 border-2 border-indigo-600 font-semibold rounded-lg hover:scale-105 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">Lanjut
                                    Belajar</button>
                                <h3 class="text-md font-semibold mt-6 mb-2">Kursus ini termasuk:</h3>
                                <ul class="space-y-2 text-sm text-slate-600">
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg> 20 Jam Video On-demand</li>
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg> 32 Artikel & Materi</li>
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg> Materi Dapat Diunduh</li>
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                        </svg> Akses Selamanya</li>
                                    <li class="flex items-center gap-3"><svg
                                            class="w-5 h-5 text-indigo-500 flex-shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 18.75h-9a9 9 0 1 0 9 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 12.75a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 15.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                        </svg> Sertifikat Kelulusan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </Layout>
</template>
<script setup>
import Layout from "@/Layout/Homepage/HomeLayout.vue"
import { usePage, router } from "@inertiajs/vue3";
import {ref} from "vue";
const page = usePage()
const openAccordionId = ref(1)

const toggleAccordion = (id) => {
    openAccordionId.value = openAccordionId.value === id ? null : id;
};

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    course: Object,
    sessions: Array,
    creator: String,
    isRegister: Boolean
})

const formatter = new Intl.NumberFormat('id-ID', {
    style: "currency",
    currency: "IDR"
});

function formatPrice(price) {
    return formatter.format(price)
}

function daftar() {
    router.get(route('register.course', props.course.slug))
}

function lanjut() {
    router.get(route('study', props.course.slug))
}

function title(str) {
    if (!str) {
        return ""
    }
    return str.toLowerCase().replace(/\b\w/g, s => s.toUpperCase());
}
</script>

<style scoped>
.accordion-content {
    overflow: hidden;
    max-height: 0;
    transition: all 0.3s;
    padding-top: 0;
    padding-bottom: 0;
}

.accordion-content.open {
    max-height: 1000px;
    /* Atur ketinggian maksimal yang cukup besar */
    padding-top: 0.75rem;
    /* 12px */
    padding-bottom: 0.75rem;
    /* 12px */
}
</style>
