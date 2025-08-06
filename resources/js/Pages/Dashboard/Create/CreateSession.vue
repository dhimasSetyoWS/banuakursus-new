<template>
    <Layout title="Tambah Session">
        <div class="mb-6">
            <Link :href="route('manage-course.edit', course.slug)"
                class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            Kembali ke Detail Kursus
            </Link>
            <h1 class="text-2xl font-bold text-slate-800 mt-2">Tambah Sesi Baru</h1>
            <p class="text-slate-500 text-sm">Untuk kursus "{{ course.title_course }}"</p>
        </div>

        <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm">
            <form @submit.prevent="submit" class="space-y-6">

                <div>
                    <label class="block text-base font-medium text-slate-700">Kategori Sesi</label>
                    <span class="text-red-600 font-bold">{{ form.errors.kategori }}</span>
                    <fieldset class="mt-2">
                        <legend class="sr-only">Pilih kategori sesi</legend>
                        <div class="flex items-center gap-8">
                            <div class="flex items-center">
                                <input id="kategori-materi" value="artikel" v-model="kategori_active" type="radio"
                                    class="h-4 w-4 text-blue-600 border-slate-300 focus:ring-blue-500">
                                <label for="kategori-materi"
                                    class="ml-3 block text-sm font-medium text-slate-800">Artikel/Materi</label>
                            </div>
                            <div class="flex items-center">
                                <input id="kategori-tugas" value="tugas" v-model="kategori_active" type="radio"
                                    class="h-4 w-4 text-blue-600 border-slate-300 focus:ring-blue-500">
                                <label for="kategori-tugas"
                                    class="ml-3 block text-sm font-medium text-slate-800">Tugas</label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div>
                    <label for="session_title" class="block text-sm font-medium text-slate-700">Judul
                        Sesi</label>
                    <span class="text-red-600 font-bold">{{ form.errors.session_name }}</span>
                    <div class="mt-1">
                        <input type="text" v-model="form.session_name" id="session_title" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: Sesi 1 - Pengenalan SEO">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Deskripsi</label>
                    <span class="text-red-600 font-bold">{{ form.errors.description }}</span>

                    <div class="mt-1">
                        <QuillEditor v-model:content="form.description"
                            :options="{ placeholder: 'Jelaskan isi dari sesi ini...' }" style="height: 200px;"
                            contentType="html"></QuillEditor>
                        <!-- <textarea id="description" name="description" rows="4"
                            class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Jelaskan isi dari sesi ini..."></textarea> -->
                    </div>
                </div>

                <div v-if="kategori_active == 'artikel'">
                    <label class="block text-sm font-medium text-slate-700">Isi Materi/Artikel</label>
                    <div class="mt-1">
                        <QuillEditor toolbar="full" v-model:content="form.artikel_konten" contentType="html"
                            style="height: 200px;" />
                    </div>
                </div>

                <div v-if="kategori_active == 'tugas'">
                    <label class="block text-sm font-medium text-slate-700">Instrukti Tugas</label>
                    <div class="mt-1">
                        <QuillEditor toolbar="full" v-model:content="form.isi_tugas" contentType="html"
                            style="height: 200px;" />
                    </div>
                    <label for="deadline" class="block text-sm font-medium text-slate-700">Tanggal
                        Deadline</label>
                    <div class="mt-1">
                        <input type="datetime-local" v-model="form.tenggat_waktu" id="deadline"
                            class="w-full sm:w-1/2 px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-4">
                    <button @click="back" type="button"
                        class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-md">
                        Batal
                    </button>
                    <button @click="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Sesi
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue"
import { useForm } from "@inertiajs/vue3";
import {watch, ref} from "vue";
import { QuillEditor } from "@vueup/vue-quill";

const props = defineProps({
    'course': Object
})

const kategori_active = ref("");

const form = useForm({
    session_name: "",
    description: "",
    kategori: kategori_active.value,
    artikel_konten : "",
    isi_tugas : "",
    tenggat_waktu : ""
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
