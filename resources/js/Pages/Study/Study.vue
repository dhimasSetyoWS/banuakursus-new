<template>

    <Head title="Study" />
    <div class="flex flex-col h-screen">
        <header class="h-16 bg-white border-b border-slate-200 flex-shrink-0">
            <div class="container mx-auto h-full flex items-center justify-between px-6">
                <a :href="route('mycourse')"
                    class="text-sm font-medium text-slate-600 hover:text-blue-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="hidden sm:block">
                        Kembali ke Dashboard
                    </div>
                </a>
                <div class="flex items-center gap-3 text-sm">
                    <span class="text-slate-500">Progres Kamu: 15%</span>
                    <div class="w-32 bg-slate-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 15%;"></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">
            <aside class="w-full md:w-80 lg:w-96 bg-white border-r border-slate-200 flex-shrink-0 flex flex-col">
                <div class="p-4 border-b border-slate-200">
                    <h2 class="font-bold text-slate-800">Materi Kursus : <span class="text-indigo-800">{{
                            course.title_course }}</span></h2>
                    <p class="font-bold text-slate-800">Kategori : <span
                            class="text-indigo-800 font-normal">{{
                            course.kategori.kategori }}</span></p>
                </div>
                <div class="flex-1 overflow-y-auto">
                    <div class="space-y-1 p-2">
                        <div>
                            <div class="pl-4 mt-1 space-y-1">
                                <a v-for="a, index in course.course_sessions" @click="changeSession(a.id)" href="javascript:"
                                    class="flex items-center gap-3 p-3 text-sm font-semibold text-blue-700 rounded-lg" :class="index == session_rn ? 'bg-blue-50' : ''">
                                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m9.15 12.75h3.879a2.25 2.25 0 0 0 2.121-3.321l-3.456-6.854a2.25 2.25 0 0 0-2.121-1.321H8.25M4.5 16.5v-2.625a3.375 3.375 0 0 1 3.375-3.375h1.5A1.125 1.125 0 0 0 10.5 7.125v-1.5a3.375 3.375 0 0 1 3.375-3.375H15M4.5 16.5h3.879a2.25 2.25 0 0 1 2.121-3.321l3.456-6.854a2.25 2.25 0 0 1 2.121-1.321H15">
                                        </path>
                                    </svg>
                                    <span>{{ a.session_name }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="flex-1 bg-white overflow-y-auto">
                <div class="max-w-4xl mx-auto p-6 md:p-8">
                    <div class="mb-6">
                        <p class="text-sm text-blue-600 font-semibold">Modul 1: Pengenalan</p>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-1">1.2 Pengenalan Search Engine
                            Optimization (SEO)</h1>
                    </div>
                    <div v-if="'artikel' in course.course_sessions[session_rn]">
                        <article class="prose prose-slate max-w-none lg:prose-lg" v-html="course.course_sessions[session_rn].artikel.konten">
                        </article>
                    </div>

                    <div class="mt-12 bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 p-2 bg-white rounded-full">
                                <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Instruksi Tugas</h3>
                                <p class="mt-1 text-slate-600">Setelah memahami materi, silakan kumpulkan file hasil
                                    riset keyword Anda dalam format `.pdf` atau `.docx` sebelum tanggal deadline.</p>
                                <div class="mt-4">
                                    <button
                                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Unggah
                                        Tugas</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-12 pt-6 border-t border-slate-200">
                        <a href="#"
                            class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-100">
                            &larr; Sesi Sebelumnya
                        </a>
                        <a href="#"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700">
                            Lanjut ke Tugas &rarr;
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

</template>
<script setup>
import {ref} from "vue";

const props = defineProps({
    'course': Object,
})

const session_rn = ref(0)

function changeSession(id) {
    const idFound = props.course.course_sessions.findIndex((session) => session.id == id)
    console.log(idFound)
    session_rn.value = idFound
}


</script>
<style>

.prose iframe {
    width: 100%;
    height: auto;
    aspect-ratio: 16 / 9;
    border-radius: 0.75rem;
}

</style>
