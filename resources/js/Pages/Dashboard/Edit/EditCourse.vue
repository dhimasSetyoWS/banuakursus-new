<template>
    <Layout title="Edit">

        <div class="mb-4">
            <h2 class="text-2xl font-bold text-slate-800">Edit Kursus</h2>
            <p class="mt-1 text-sm text-slate-500">Edit kursus yang telah anda buat di platform Banua Kursus.</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm">
            <div class="px-4 py-2">
                <section class="detail-course gap-3 px-3 my-5 flex flex-col lg:flex-row lg:justify-between">
                    <img class="thumbnail rounded" src="https://placehold.co/1280x720/8b5cf6/ffffff?text=WEB" alt=""
                        width="320" height="180">
                    <form @submit.prevent="updateCourse" class="flex-1 max-w-lg mt-3 sm:mt-auto items-center">
                        <div class="flex flex-col mb-5">
                            <label for="title">Judul Kursus</label>
                            <input id="title" type="text" v-model="form.title_course"
                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                autocomplete="off">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="desc">Deskripsi Kursus</label>
                            <QuillEditor v-model:content="form.description" style="height : 150px" contentType="html" />
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="period_academic" class="block text-sm font-medium text-slate-700">Periode
                                Akademik</label>
                            <select v-model="form.period_id" id="period_academic"
                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-3">
                                <option v-for="period in periods" :key="period" :value="period.period_id" class="">{{
                                    period.period_name }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="price">Harga Kursus</label>
                            <input id="price" @input="formatPrice" type="number" v-model="form.price"
                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <small class="text-gray-600">Format dalam Currency</small>
                            <p class="text-lg ms-2 ps-3 mt-2 text-gray-600 border-s">{{ formatted }}</p>
                        </div>
                    </form>
                </section>
                <!-- End of detail course -->
                <hr class="my-6">
                <ul class="flex border-b">
                    <li class="-mb-px mr-1">
                        <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold"
                            href="#">Session</a>
                    </li>
                    <li class="mr-1">
                        <a class="bg-white inline-block  py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                            href="#">Siswa</a>
                    </li>
                </ul>
                <div class="mt-4">
                    <div
                        class="headSection mb-12 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-3 sm:gap-0">
                        <div class="desc">
                            <div class="text-lg font-bold text-slate-800">Session Course</div>
                            <div class="text-sm text-slate-500">Edit session dari course anda yang telah
                                dibuat di Banua Kursus
                            </div>
                        </div>
                        <Link :href="route('session.create', course.slug)"
                            class="mt-3 lg:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Session Baru
                        </Link>
                    </div>


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-600 text-gray-50">
                                <tr>
                                    <th class="text-left font-medium p-3">Judul Session</th>
                                    <th class="text-left font-medium p-3">Kategori</th>
                                    <th class="text-center font-medium p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-slate-800 text-gray-50">
                                <tr v-if="sessions.length > 0" v-for="data in sessions" class="border-b border-slate-200 hover:bg-slate-700">
                                    <td class="p-3">{{ data.session_name }}</td>
                                    <td class="p-3">{{ capitalize(data.kategori) }}</td>
                                    <td class="p-3 text-center">
                                        <button @click="editSession(data.id)" class="text-gray-50 hover:text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                        <button @click="deleteSession(data.id)" class="text-red-500 hover:text-red-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-b border-slate-200 hover:bg-slate-700">
                                    <td class="p-3">Belum ada session saat ini</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- <div v-for="a in sessions" :key="a" href="#"
                            class="mx-auto content-center relative block max-w-sm p-6 border rounded-lg shadow-sm bg-gray-800 border-gray-700 min-h-[200px] max-h-[200px] overflow-y-hidden transition-transform hover:-translate-y-1">
                            <div class="absolute right-0 top-0">
                                <button @click="editSession(a.id)"
                                    class=" text-white px-2 py-2 bg-gray-600 hover:bg-gray-700 rounded-bl"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button @click="deleteSession(a.id)"
                                    class="text-white px-2 py-2 bg-gray-600 hover:bg-gray-700"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                            <h5
                                class="hover:cursor-default mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{
                                    a.session_name }}</h5>
                            <p class="hover:cursor-default font-normal text-gray-700 dark:text-gray-400"
                                v-html="a.description"></p>
                        </div> -->
                </div>
            </div>
            <div class="flex justify-end p-3 gap-3">
                <button @click="cancel" class="px-2 py-2 border border-slate-300 rounded">Cancel</button>
                <button @click="updateCourse" class="px-2 py-2 bg-indigo-500 rounded text-slate-200">Submit</button>
            </div>
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
    }
})
const listofModule = ref(props.modules);

const formatter = new Intl.NumberFormat('id-ID', {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0
});

function editSession(sessionId) {
    location.href = route('session.edit', sessionId)
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
});

// Course Section
function updateCourse() {
    form.patch(route('manage-course.update', props.course.slug));
}

// End of section

// delete module secara spesifik
function deleteModule(id) {
    console.log(id);
    router.delete(route('module.delete', id), {
        onSuccess: () => {
            location.reload();
        }
    });
}

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
