<template>
    <Layout title="Edit">
        <div class="max-w-7xl mx-auto">
            <div class="mb-6">
                <a :href="route('manage-course')" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-2 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Kembali ke Manajemen Kursus
                </a>
                <h1 class="text-3xl font-bold text-slate-800 mt-2">Edit Detail Kursus</h1>
                <p class="text-slate-500">Anda sedang mengubah data untuk kursus "{{ course.title_course }}".</p>
            </div>

            <form @submit.prevent="updateCourse" class="space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm">
                            <h2 class="text-xl font-semibold text-slate-800 mb-6">Informasi Dasar</h2>
                            <div class="space-y-6">
                                <div>
                                    <label for="course_name" class="block text-sm font-medium text-slate-700">Nama
                                        Kursus</label>
                                    <input type="text" v-model="form.title_course" id="course_name"
                                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="category"
                                        class="block text-sm font-medium text-slate-700">Kategori</label>
                                    <select id="category" v-model="form.kategori_id"
                                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="" disabled>Pilih Kategori</option>
                                        <option v-for="data in kategori" :key="data.kategori_id" :value='data.kategori_id'>{{ data.kategori }}</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="period" class="block text-sm font-medium text-slate-700">Periode</label>
                                    <select id="period" v-model="form.period_id"
                                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="" disabled>Pilih Periode</option>
                                        <option v-for="data in periods" :value='data.period_id'>{{ data.period_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="h-full">
                                    <label for="description"
                                        class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                                    <QuillEditor v-model:content="form.description" style="height:200px;"
                                        contentType="html"></QuillEditor>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-8">
                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4">Harga</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="relative mt-1">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-slate-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" v-model="form.price" id="price"
                                            class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4">Gambar Thumbnail</h3>
                            <img src="https://placehold.co/600x400/3b82f6/ffffff?text=Marketing"
                                class="w-full rounded-lg object-cover mb-4" alt="Course Thumbnail">
                            <button type="button"
                                class="w-full px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">Ubah
                                Gambar</button>
                        </div>
                    </div>
                </div>

                <div id="session-list" class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-slate-800">Manajemen Sesi</h2>
                        <button @click.prevent="createSession"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                            Tambah Sesi Baru
                        </button>
                    </div>

                    <div class="space-y-3">
                        <div
                            class="flex items-center justify-between bg-slate-50 p-3 rounded-lg border border-slate-200">
                            <div v-if="sessions.length > 0" class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-slate-400 cursor-grab" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                                </svg>
                                <div>
                                    <span class="font-semibold text-sm">Tugas 1: Membuat Halaman Sederhana</span>
                                    <span
                                        class="ml-2 px-2 py-0.5 text-xs font-medium text-orange-700 bg-orange-100 rounded-full">Tugas</span>
                                </div>
                            </div>
                            <div v-if="sessions.length > 0" class="flex items-center gap-2">
                                <button type="button"
                                    class="p-1.5 text-slate-500 hover:text-blue-600 rounded-md hover:bg-slate-200"><svg
                                        class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z">
                                        </path>
                                    </svg></button>
                                <button type="button"
                                    class="p-1.5 text-slate-500 hover:text-red-600 rounded-md hover:bg-slate-200"><svg
                                        class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                        </path>
                                    </svg></button>
                            </div>
                            <div class="font-semibold text-sm">Tidak ada sesi saat ini.</div>
                        </div>

                    </div>
                </div>

                <div class="mt-8 flex justify-end items-center gap-4">
                    <button @click="deleteCourse" class="text-sm font-semibold text-red-600 hover:text-red-800">Hapus Kursus</button>
                    <a :href="route('manage-course')"
                        class="px-6 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>

    </Layout>
</template>

<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue";
import { useForm, router } from "@inertiajs/vue3"
import { ref, reactive } from "vue";
import { route } from "../../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    course: {
        type: Object
    },
    periods: {
        type: Array
    },
    sessions: {
        type: Array
    },
    kategori : {
        type : Array
    }
})
const listofModule = ref(props.modules);

const formatter = new Intl.NumberFormat('id-ID', {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0
});

// Session section
function createSession() {
    router.get(route('session.create' , props.course.slug))
}

function editSession(sessionId) {
    router.get(route('session.edit', sessionId))
}

function deleteSession(sessiondId) {
    router.delete(route('session.delete', sessiondId));
}

const formatted = ref(formatter.format(props.course.price))

// Course
const form = useForm({
    title_course: props.course.title_course,
    description: props.course.description,
    price: props.course.price,
    period_id: props.course.period_id,
    kategori : props.course.kategori_id
});

// Course Section
function updateCourse() {
    form.patch(route('manage-course.update', props.course.slug));
}

function deleteCourse() {
    router.delete(route('manage-course.delete' , props.course.slug));
}

// End of section

function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function formatPrice() {
    formatted.value = formatter.format(form.price)
}

function cancel() {
    location.href = route('manage-course')
}
</script>
