<template>
    <Layout title="Tambah Kursus">
        <div class="max-w-7xl mx-auto">
            <div class="mb-6">
                <a :href="route('session.edit', session.id)"
                    class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-2 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Kembali ke Edit Sesi
                </a>
                <h1 class="text-3xl font-bold text-slate-800 mt-2">Buat Soal</h1>
                <p class="text-slate-500">Silahkan buat soal untuk sesi.</p>
            </div>

            <!-- Quill Editor -->
            <form @submit="submit" class="space-y-8">
                <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm h-full">
                    <div class="text-xl font-semibold text-slate-800 mb-6 space-y-2">
                        <h2>Informasi Soal</h2>
                        <hr>
                    </div>
                    <div class="space-y-6">
                        <div class="h-full">
                            <label for="description" class="ps-1 block text-sm font-medium text-slate-700 mb-1">Isi Soal</label>
                            <QuillEditor v-model:content="form.content" style="height:300px;" contentType="html">
                            </QuillEditor>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Start Date -->
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Waktu Mulai</label>
                    <input type="date" v-model="form.startDate"
                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>

                <!-- End Date (Optional) -->
                <div>
                    <label class="block text-sm font-medium text-slate-700">
                        Waktu Berakhir <span class="text-gray-500 text-xs">(opsional)</span>
                    </label>
                    <input type="date" v-model="form.endDate"
                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2 py-5">
                <a :href="route('session.edit', session.id)" 
                class="px-10 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-xl">Batal</a>
                <button @click="submitAssignment"
                    class="bg-blue-600 text-white px-6 py-2 rounded-xl shadow hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({
    session: Object
})

const form = useForm({
    content: "",
    startDate: "",
    endDate: ""
});

const submitAssignment = () => {
    console.log("Data Assignment:", form.value);

    if (!form.value.content || !form.value.startDate) {
        alert("Konten soal dan tanggal mulai wajib diisi!");
        return;
    }

    // endDate bisa kosong (opsional)
    alert("Assignment berhasil dibuat!");
};
</script>
