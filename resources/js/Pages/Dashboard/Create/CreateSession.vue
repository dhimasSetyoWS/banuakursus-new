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
                <p class="text-slate-500">Isi detail sesi.</p>
            </div>

            <form @submit.prevent="submit" method="POST">
                <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm space-y-8">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-800">Detail Sesi</h2>
                        <hr class="my-4">
                        <div class="space-y-6">
                            <div>
                                <label for="session_name" class="block text-sm font-medium text-slate-700">Nama
                                    Sesi</label>
                                <input type="text" v-model="form.session_name" id="session_name"
                                    placeholder="Contoh: Pengenalan Dasar HTML"
                                    class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="off">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-slate-700">Waktu
                                        Mulai</label>
                                    <input type="datetime-local" v-model="form.start_session" id="start_time"
                                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="end_time" class="block text-sm font-medium text-slate-700">Waktu
                                        Berakhir</label>
                                    <input type="datetime-local" v-model="form.end_session" id="end_time"
                                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
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
import { route } from "../../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    'course': Object
})


const form = useForm({
    session_name: "",
    start_session : "",
    end_session : ""
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
