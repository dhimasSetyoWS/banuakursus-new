<template>
    <Layout title="Kursus Saya">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-800">Kursus Saya</h1>
                <p class="mt-1 text-slate-500">Lanjutkan perjalanan belajarmu dan tingkatkan keahlianmu di sini.</p>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4">
                <div class="w-full md:w-auto flex flex-col md:flex-row gap-4">
                    <div class="relative w-full md:w-64">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z">
                            </path>
                        </svg>
                        <input type="search" placeholder="Cari kursus..."
                            class="w-full pl-10 pr-4 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <select
                        class="w-full md:w-auto text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="marketing">Marketing</option>
                        <option value="desain">Desain</option>
                        <option value="teknologi">Teknologi</option>
                    </select>
                </div>
                <div class="w-full md:w-auto">
                    <a :href="route('catalog')"
                        class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        Beli Kursus Baru
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div v-for="a in courses"
                    class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <a :href="route('course' , a.slug)"><img src="https://placehold.co/600x400/000000/ffffff?text=kursus"
                            class="h-40 w-full object-cover" alt="Course thumbnail"></a>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="font-semibold text-slate-800 leading-snug mb-2">{{ a.title_course }}</h3>
                        <div class="space-y-1 mb-4">
                            <div class="flex justify-between items-center text-xs text-slate-500">
                                <span>Progress</span>
                                <span>10%</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 10%;"></div>
                            </div>
                        </div>
                        <div class="mt-auto space-y-2">
                            <a href="#"
                                class="block w-full text-center px-4 py-2 bg-blue-50 text-blue-700 text-sm font-semibold rounded-lg hover:bg-blue-100">Lanjutkan
                                Belajar</a>
                            <button @click="detail(a.slug)"
                                class="block w-full text-center px-4 py-2 bg-blue-50 text-blue-700 text-sm font-semibold rounded-lg hover:bg-blue-100">Detail
                                Kursus</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </Layout>
</template>
<script setup>
import Layout from '@/Layout/Dashboard/DashboardLayout.vue';
import { route } from '../../../../../vendor/tightenco/ziggy/src/js';

defineProps({
    'courses': Array
})

function detail(slug) {
    location.href = route('course', slug)
}

</script>
<style scoped></style>
