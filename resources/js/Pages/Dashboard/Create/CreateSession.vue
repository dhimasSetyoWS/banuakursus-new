<template>
    <Layout title="Tambah Session">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a :href="route('manage-course.edit' , course.slug)+ '#session-list'" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-2 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali ke Daftar Sesi
                </a>
                <h1 class="text-3xl font-bold text-slate-800 mt-2">Buat Sesi Baru</h1>
                <p class="text-slate-500">Isi detail sesi dan tambahkan materi, kuis, atau tugas.</p>
            </div>

            <form action="#" method="POST">
                <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm space-y-8">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-800">Detail Sesi</h2>
                        <hr class="my-4">
                        <div class="space-y-6">
                            <div>
                                <label for="session_name" class="block text-sm font-medium text-slate-700">Nama
                                    Sesi</label>
                                <input type="text" name="session_name" id="session_name"
                                    placeholder="Contoh: Pengenalan Dasar HTML"
                                    class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-slate-700">Waktu
                                        Mulai</label>
                                    <input type="datetime-local" name="start_time" id="start_time"
                                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="end_time" class="block text-sm font-medium text-slate-700">Waktu
                                        Berakhir</label>
                                    <input type="datetime-local" name="end_time" id="end_time"
                                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold text-slate-800">Konten Sesi</h2>
                        <hr class="my-4">
                        <div class="border border-slate-200 rounded-lg p-4 min-h-[10rem] space-y-3">
                            <div class="flex items-center justify-between bg-slate-50 p-3 rounded-md">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m9.15 12.75h3.879a2.25 2.25 0 0 0 2.121-3.321l-3.456-6.854a2.25 2.25 0 0 0-2.121-1.321H8.25M4.5 16.5v-2.625a3.375 3.375 0 0 1 3.375-3.375h1.5A1.125 1.125 0 0 0 10.5 7.125v-1.5a3.375 3.375 0 0 1 3.375-3.375H15M4.5 16.5h3.879a2.25 2.25 0 0 1 2.121-3.321l3.456-6.854a2.25 2.25 0 0 1 2.121-1.321H15">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-sm">Materi 1: Pengenalan HTML.pdf</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" class="p-1 text-slate-500 hover:text-blue-600"><svg
                                            class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
                                            </path>
                                        </svg></button>
                                    <button type="button" class="p-1 text-slate-500 hover:text-red-600"><svg
                                            class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg></button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between bg-slate-50 p-3 rounded-md">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-sm">Kuis: Dasar-Dasar HTML</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" class="p-1 text-slate-500 hover:text-blue-600"><svg
                                            class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
                                            </path>
                                        </svg></button>
                                    <button type="button" class="p-1 text-slate-500 hover:text-red-600"><svg
                                            class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg></button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-wrap items-center gap-4">
                            <button type="button"
                                class="px-3 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">+
                                Tambah Materi</button>
                            <button type="button"
                                class="px-3 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">+
                                Tambah Kuis</button>
                            <button type="button"
                                class="px-3 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">+
                                Tambah Ujian</button>
                            <button type="button"
                                class="px-3 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">+
                                Tambah Proyek</button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-6">
                    <a :href="route('manage-course.edit' , course.slug) + '#session-list'" class="text-sm font-semibold text-slate-600">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Publikasikan Sesi
                    </button>
                </div>
            </form>
        </div>

    </Layout>
</template>
<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue"
import { useForm } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import { QuillEditor } from "@vueup/vue-quill";

const props = defineProps({
    'course': Object
})

const kategori_active = ref("");

const form = useForm({
    session_name: "",
    description: "",
    kategori: kategori_active.value,
    artikel_konten: "",
    isi_tugas: "",
    tenggat_waktu: ""
})

watch(kategori_active, (newKategori) => {
    form.kategori = newKategori;

    // 2. Reset semua field kondisional yang mungkin tidak relevan lagi
    form.artikel_konten = "";
    form.isi_tugas = "";
    form.tenggat_waktu = "";
});

function submit() {
    form.post(route('session.store', props.course.id), {
        onSuccess: () => form.reset()
    })
}

function back() {
    location.href = route('manage-course.edit', props.course.slug)
}
</script>
<style scoped></style>
