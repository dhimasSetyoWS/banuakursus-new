<template>
    <Layout title="Tambah Kursus">
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
                <h1 class="text-3xl font-bold text-slate-800 mt-2">Tambah Kursus</h1>
                <p class="text-slate-500">Silahkan tambahkan kursus.</p>
            </div>

            <form @submit="submit" class="space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm h-full">
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
                                        <option value="" selected disabled>Pilih Kategori</option>
                                        <option v-for="data in kategori" :value='data.id'>{{ data.kategori }}</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="period"
                                        class="block text-sm font-medium text-slate-700">Periode</label>
                                    <select id="period" v-model="form.period_id"
                                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="" selected disabled>Pilih Periode</option>
                                        <option v-for="data in periods" :value='data.period_id'>{{ data.period_name }}</option>
                                    </select>
                                </div>
                                <div class="h-full">
                                    <label for="description"
                                        class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                                        <QuillEditor v-model:content="form.description" style="height:200px;" contentType="html"></QuillEditor>
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
                                            <span class="text-slate-500 sm:text-sm">Rp</span></div>
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

                <div class="mt-8 flex justify-end items-center gap-4">
                    <a :href="route('manage-course')"
                        class="px-6 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Buat Kursus</button>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({
    kategori : Array,
    periods : Array,
})

const form = useForm({
    title_course: '',
    description: '',
    price: '',
    period_id: '',
    kategori_id: ''
});

const submit = async () => {
    const a = await form.post(route('manage-course.store'), {
        onSuccess: () => {
            form.reset()
            formatter.value = "Rp 0,00"
        }
    });
    setTimeout(function () {
        isModal.value = false
    }, 2000)
};
</script>
<style scoped></style>
