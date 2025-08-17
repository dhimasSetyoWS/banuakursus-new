<template>
    <Layout title="Edit">
        <div class="max-w-7xl mx-auto">
            <div class="mb-6">
                <a :href="route('manage-course')"
                    class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-2 w-fit">
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
                                        <option v-for="data in kategori" :key="data.kategori_id"
                                            :value='data.kategori_id'>{{ data.kategori }}</option>
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
                <section id="session_list">
                    <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-slate-800">Manajemen Sesi</h2>
                            <button type="button" @click.prevent="createSession"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                                </svg>
                                Tambah Sesi Baru
                            </button>
                        </div>

                        <div class="space-y-3">
                            <div v-if="sessions.length > 0" class="border border-slate-200 rounded-lg" v-for="data, index in sessions" :key="data.id">
                            <div class="flex items-center justify-between bg-slate-50 p-3">
                                    <div class="flex items-center gap-3">
                                        <!-- <button type="button" @click="toggleAccordion(index + 1)"
                                            class="p-1.5 rounded-md hover:bg-slate-200">
                                            <svg class="w-5 h-5 text-slate-500 transition-transform duration-300"
                                                :class="{ 'rotate-90': openAccordionId === index + 1 }"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button> -->
                                        <div>
                                            <span class="font-semibold text-sm">{{ data.session_name }}</span>
                                            <span
                                                class="ml-2 px-2 py-0.5 text-xs font-medium text-green-700 bg-green-100 rounded-full">Sesi
                                                {{ index + 1 }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <ButtonEdit @click="editSession(data.id)"/>
                                        <ButtonDelete @click="deleteSession(data.id)"/>
                                    </div>
                                </div>
                                <!-- <div class="px-3 accordion-content" :class="{ 'open': openAccordionId === index + 1 }">
                                    <div class="border-t border-slate-200 space-y-2 pt-3">
                                        <div
                                            class="flex items-center justify-between text-sm p-2 rounded-md hover:bg-slate-50">
                                            <span class="text-slate-600">Materi : </span>
                                            <div class="flex items-center gap-2">
                                                <ButtonEdit/>
                                                <ButtonDelete/>
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
                                        <button
                                            type="button" class="w-full text-center text-sm font-semibold text-blue-600 hover:bg-blue-50 rounded-md p-2">+
                                            Tambah Konten</button>
                                    </div>
                                </div> -->
                            </div>
                            <div v-else class="font-semibold text-sm bg-slate-50 p-3 rounded-lg border border-slate-200">Tidak ada
                                sesi saat ini.</div>
                        </div>
                    </div>
                </section>

                <div class="mt-8 flex justify-end items-center gap-4">
                    <button type='button' @click="deleteCourse" class="text-sm font-semibold text-red-600 hover:text-red-800">Hapus
                        Kursus</button>
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
import { ref } from "vue";
import ButtonEdit from "@/Components/Global/ButtonEdit.vue";
import ButtonDelete from "@/Components/Global/ButtonDelete.vue";
import Swal from "sweetalert2";

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
    kategori: {
        type: Array
    }
})
const openAccordionId = ref(1)

const toggleAccordion = (id) => {
    // Jika accordion yang diklik sudah terbuka, tutup (set ke null)
    // Jika tidak, buka accordion tersebut (set ke id-nya)
    openAccordionId.value = openAccordionId.value === id ? null : id;
};

const formatter = new Intl.NumberFormat('id-ID', {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0
});

// Session section
function createSession() {
    router.get(route('session.create', props.course.slug))
}

function editSession(sessionId) {
    router.get(route('session.edit', sessionId))
}

function deleteSession(sessiondId) {
    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Tindakan ini akan menghapus sesi ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya yakin!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('session.delete', sessiondId));
        }
    });
}

const formatted = ref(formatter.format(props.course.price))

// Course
const form = useForm({
    title_course: props.course.title_course,
    description: props.course.description,
    price: props.course.price,
    period_id: props.course.period_id,
    kategori: props.course.kategori_id
});

// Course Section
function updateCourse() {
    form.patch(route('manage-course.update', props.course.slug));
}

function deleteCourse() {
    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Tindakan ini akan menghapus kursus ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya yakin!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('manage-course.delete', props.course.slug));
        }
    });
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
