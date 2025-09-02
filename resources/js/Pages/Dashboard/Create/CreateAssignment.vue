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
                    <div class="text-sm font-semibold text-slate-800 mb-6 space-y-2">
                        <h2>Informasi Soal</h2>
                        <input type="text" v-model="form.title" id="material_title"
                            placeholder="Masukkan judul assignment"
                            class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            autocomplete="off">
                        <hr>
                    </div>
                    <div class="mb-3 space-x-3">
                        <Button @click="mode = mode ? null : 10" text="Tambah Soal" type="blue" />
                        <Button @click="bankSoal = !bankSoal" text="Bank Soal" type="green" />
                    </div>
                    <div v-if="mode == 10" class="space-y-6 py-4">
                        <div class="h-full">
                            <label for="description" class="ps-1 block text-sm font-bold text-slate-700 mb-1">Soal</label>
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
                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- End Date (Optional) -->
                <div>
                    <label class="block text-sm font-medium text-slate-700">
                        Waktu Berakhir <span class="text-gray-500 text-xs">(opsional)</span>
                    </label>
                    <input type="date" v-model="form.endDate"
                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end items-center space-x-4 py-5">
                <a :href="route('session.edit', session.id)"
                    class="text-red-600 font-semibold rounded-xl">Batal</a>
                <button @click="submitAssignment"
                    class="bg-blue-600 text-white px-6 py-2 rounded-xl shadow hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </div>
    </Layout>
    <div v-if="bankSoal">
        <div class="overlay w-screen h-screen bg-black absolute inset-0" />
        <div id="bankSoal"
            class="fadeIn modal m-12 absolute inset-0 rounded-lg bg-white overflow-y-auto overflow-x-hidden">
            <div class="p-8">
                <div class="relative p-4 bg-primary text-white rounded-ss-lg rounded-se-lg border-b border-slate-200">
                    <h3 class="text-lg font-semibold">Bank Soal</h3>
                    <p class="text-sm">Soal - soal yang tersedia di Banua Kursus.</p>
                    <div class="absolute -top-3 -right-3">
                        <button @click="bankSoal = !bankSoal" class="bg-primary text-white p-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <table class="w-full min-w-[800px] text-sm text-left">
                    <thead class="text-black">
                        <tr>
                            <th class="p-3 font-medium">Soal</th>
                            <th class="p-3 font-medium text-center">Gunakan?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="a in 3" :key="a" class="border-b border-slate-200 hover:bg-slate-50">
                            <td class="max-w-lg p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde,
                                maxime. Consequatur vero quaerat sed ullam vel minus eum nostrum tempore eius rem
                                repellat ad, pariatur dolores consectetur excepturi dolore laborum.</td>
                            <td class="p-3 flex justify-center"><input type="checkbox" name="" id=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue";
import { useForm } from "@inertiajs/vue3";
import Button from "@/Components/Global/Button.vue";
import { ref } from "vue";
defineProps({
    session: Object
})

const mode = ref(null);
const bankSoal = ref(false);

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

<style scoped>
@keyframes fadeOverlay {
    from {
        opacity: 0;
    }

    to {
        opacity: 0.2;
    }
}

.overlay {
    animation: fadeOverlay 1s ease-in-out;
    opacity: 0.2
}
</style>
