<template>
    <Layout title="Edit Session">
        <div class="max-w-4xl mx-auto space-y-2">
            <div class="mb-6">
                <a :href="route('manage-course.edit', course.slug)"
                    class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-2 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali ke Daftar Sesi
                </a>
                <h1 class="text-3xl font-bold text-slate-800 mt-2">Edit Sesi</h1>
                <p class="text-slate-500">Edit detail sesi.</p>
            </div>

            <form @submit.prevent="submit">
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
                                    class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    autocomplete="off">
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
            </form>
            <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm">
                <div class="mb-3 flex justify-between items-center">
                    <div class="font-bold text-sm">Manajemen Konten</div>
                    <div class="relative space-y-2">
                        <button type="button" @click="toggleDropdown"
                            class="cursor-pointer inline-flex items-center px-4 ps-2 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
                            <svg class="w-5 h-5 text-white transition-transform duration-300"
                                :class="{ 'rotate-90': openDropdown }" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Tambah
                        </button>
                        <div class="absolute accordion-content py-2 text-center rounded-lg w-fit bg-blue-600"
                            :class="{ 'open': openDropdown }">
                            <div class="border-slate-200 space-y-2 py-2 mt-1">
                                <a :href="route('material.create', session.id)"
                                    class="hover:bg-blue-700 py-2 px-4 rounded-lg mx-2 text-white">
                                    Materi
                                </a>
                            </div>
                            <div class="border-slate-200 space-y-2 py-2">
                                <a :href="route('assignment.create' , session.id)" class="hover:bg-blue-700 py-2 px-4 rounded-lg mx-2 text-white">
                                    Assignment
                                </a>
                            </div>
                            <div class="border-slate-200 space-y-2 py-2">
                                <a :href="route('exam.create' , session.id)" class="hover:bg-blue-700 py-2 px-4 rounded-lg mx-2 text-white">
                                    Exam
                                </a>
                            </div>
                            <div class="border-slate-200 space-y-2 py-2 mb-1">
                                <a href="" class="hover:bg-blue-700 py-2 px-4 rounded-lg mx-2 text-white">
                                    Project
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-3">
                <section id="content_list" class="space-y-2">
                    <div id="material" class="space-y-2">
                        <div class="border border-slate-200 rounded-lg" v-for="data, index in material">
                            <div class="flex items-center justify-between bg-slate-50 p-3">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <span class="font-semibold text-sm">Materi : {{ data.title }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <ButtonEdit @click="editMaterial(data.id)" />
                                    <ButtonDelete @click="deleteMaterial(data.id)" />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="flex items-center justify-end gap-4 pt-6">
                <a :href="route('manage-course.edit', course.slug) + '#session_list'"
                    class="text-sm font-semibold text-slate-600">Batal</a>
                <Button text="Update Sesi" type="blue"/>
            </div>
        </div>
    </Layout>
</template>
<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue"
import { useForm, router } from "@inertiajs/vue3";
import { ref } from "vue";
import ButtonDelete from "@/Components/Global/ButtonDelete.vue";
import ButtonEdit from "@/Components/Global/ButtonEdit.vue";
import Button from "@/Components/Global/Button.vue";
import Swal from "sweetalert2";

const openDropdown = ref(false)
const toggleDropdown = () => {
    // Jika dropdown yang diklik sudah terbuka, tutup (set ke null)
    // Jika tidak, buka accordion tersebut (set ke id-nya)
    openDropdown.value = !openDropdown.value
};

if (openDropdown.value == true) {
    window.addEventListener("click", function () {
        openDropdown.value = false
    });
}
const props = defineProps({
    course: Object,
    session: Object,
    material: Array
})

const form = useForm({
    session_name: props.session.session_name,
    start_session: props.session.start_session,
    end_session: props.session.end_session,
})

function submit() {
    form.post(route('session.update', [props.course.id, props.session.id]), {
        onSuccess: () => form.reset()
    })
}

function editMaterial(materialId) {
    router.get(route('material.edit', [props.session.id, materialId]))
}

function deleteMaterial(materialId) {
    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Tindakan ini akan menghapus konten ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya yakin!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('material.delete', [props.session.id, materialId]));
        }
    });
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
}
</style>
