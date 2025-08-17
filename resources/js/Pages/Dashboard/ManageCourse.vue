<template>
    <Layout title="Manage Course">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Daftar Kursus</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola semua kursus yang ada di platform Banua Kursus.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a @click="createCourse" href="#"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Kursus Baru
                </a>
            </div>
        </div>

        <div class="mb-4 flex flex-col sm:flex-row items-center gap-4">
            <div class="relative w-full sm:w-auto sm:flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
                <input v-model="searchQuery" type="text" placeholder="Cari berdasarkan nama kursus..."
                    class="w-full pl-10 pr-4 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>
        <div v-if="$page.props.flash.message" class="flex">
            <div class="px-2 py-4 text-green-600 rounded mb-4 inline-block font-bold">
                {{ $page.props.flash.message }} !
            </div>
        </div>
        <div v-if="$page.props.flash.delete" class="flex">
            <div class="px-2 py-4 text-red-600 rounded mb-4 inline-block font-bold">
                {{ $page.props.flash.delete }} !
            </div>
        </div>
        <div class="hidden lg:block bg-white rounded-lg border border-slate-200 shadow-sm">
            <div class="overflow-x-auto">
                <!-- Table List Kursus -->
                <table class="w-full min-w-[800px] text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="p-3 font-medium">Nama Kursus</th>
                            <th class="p-3 font-medium">Deskripsi</th>
                            <th class="p-3 font-medium">Harga</th>
                            <th class="p-3 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="courses.length == 0">
                            <td class="p-3">Anda belum membuat Courses !</td>
                        </tr>
                        <tr v-for="data in courses.data" :key="data"
                            class="border-b border-slate-200 hover:bg-slate-50">
                            <!-- Name -->
                            <td class="p-3">
                                <div class="flex items-center gap-3">
                                    <!-- <img src="https://placehold.co/100x60/8b5cf6/ffffff?text=WEB" alt="Kursus"
                                        class="w-20 h-12 object-cover rounded-md"> -->
                                    <a :href="route('course', data.slug)" class="font-semibold">{{ data.title_course
                                        }}</a>
                                </div>
                            </td>
                            <!-- Desc -->
                            <td class="p-3" v-html="limitString(data.description, 100)"></td>
                            <!-- Price -->
                            <td class="p-3">{{ formatter.format(data.price) }}</td>
                            <!-- Action -->
                            <td class="p-3">
                                <div class="flex items-center justify-center gap-2">
                                    <ButtonEdit @click="editCourse(data.slug)" />
                                    <ButtonDelete @click="deleteCourse(data.id)" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- {{ courses.links }} -->
            </div>
        </div>
        <div class="grid grid-cols-1 lg:hidden">
            <div v-for="data in courses.data" :key="data" class="relative flex flex-col my-4 bg-white shadow-sm border border-slate-200 rounded-lg w-full hover:scale-[1.02] transition-all hover:cursor-default">
                <div class="absolute top-0 right-0 p-3 z-10">
                    <ButtonEdit/>
                    <ButtonDelete/>
                </div>
                <div class="p-4 pt-8">
                    <h5 class="mb-2 text-slate-800 text-xl font-semibold">
                        Nama Kursus : {{ data.title_course }}
                    </h5>
                    <p class="text-slate-600 leading-normal font-light"
                    v-html="limitString(data.description, 100)">
                </p>
                <div class="detail mt-3">
                    <p class="text-slate-600 text-sm font-semibold">Harga : {{ formatter.format(courses.data[0].price)
                            }}</p>
                    </div>
                </div>
            </div>
        </div>
        <Pagination :links="courses.links" />
    </Layout>
    <!-- Modal -->
</template>
<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue";
import Pagination from "@/Components/Global/Pagination.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3"
import { debounce } from "lodash";
import ButtonEdit from "@/Components/Global/ButtonEdit.vue";
import ButtonDelete from "@/Components/Global/ButtonDelete.vue";
import Swal from "sweetalert2";

const props = defineProps({
    courses: {
        type: Object
    },
    periods: {
        type: Array
    },
    search: {
        type: String
    },
    kategori: {
        type: Array
    }
})

const searchQuery = ref(props.search)

watch(searchQuery,
    debounce((q) => router.get(route('manage-course'),
        { search: q }, { preserveState: true, preserveScroll: true }
    ), 200) // debounce dari lodash akan mengeksekusi code setelah kita berhenti menginput di input field
    // jadi kan kalau kita cuman pakai watch dia akan jalankan callback function setiap kali ada perubahan pada parameter pertama, yakni searchQuery, nah dengan kita gunakan debouunce, maka itu tidak akan terjadi
);

const formatted = ref("Rp 0,00")

// Format to currency

const formatter = new Intl.NumberFormat('id-ID', {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0
});

function formatPrice() {
    formatted.value = formatter.format(form.price)
}

// End of format

function limitString(str, maxLength, suffix = '...') {
    if (str.length <= maxLength) {
        return str;
    }
    return str.substring(0, maxLength) + suffix;
}

// Create Course
function createCourse() {
    router.get(route('manage-course.create'));
}
// Delete course
function deleteCourse(courseId) {
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
            router.delete(route('manage-course.delete', courseId)); // delete course
        }
    });
}
// Edit course
function editCourse(slug) {
    router.get(route('manage-course.edit', slug));
}
</script>
<style scoped></style>
