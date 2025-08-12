<template>
    <Layout title="Kategori">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Kategori</h2>
                    <p class="mt-1 text-sm text-slate-500">Edit atau tambah kategori kursus yang ada di banua kursus.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a @click="toggleModal" href="#"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Kategori
                    </a>
                </div>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="text-left font-medium p-3">ID</th>
                        <th class="text-left font-medium p-3">Nama Kategori</th>
                        <th class="text-left font-medium p-3">Slug</th>
                        <th class="text-center font-medium p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="a, index in kategori" class="border-b bg-white border-slate-200 hover:bg-slate-50">
                        <td class="p-3">{{ a.id }}</td>
                        <td class="p-3">{{ a.kategori }}</td>
                        <td class="p-3">{{ a.slug }}</td>
                        <td class="p-3 text-right">
                            <div class="flex justify-center gap-2">
                                <!-- Remove Button -->
                                <button @click="deleteKategori(a.id)" class="text-slate-500 hover:text-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                                <!-- Edit Button -->
                                <button @click="editKategori(a.id)" class="text-slate-500 hover:text-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>

                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div v-if="isModal" class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
            <div v-if="isModal" id="modal" class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-center shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4">
                                <div class="headModal w-full border-b mb-3 pb-3">
                                    <h3 class="font-semibold text-gray-900" id="dialog-title">Tambah Kategori</h3>
                                </div>
                                <div class="bodyModal text-start">
                                    <form @submit.prevent="submit">
                                        <div>
                                            <label for="kategori"
                                                class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                                            <input id="kategori" v-model="form.kategori" type="text" autocomplete="off"
                                                required
                                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button v-if="!form.kategori.length" @click="submit" type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 sm:ml-3 sm:w-auto disabled:bg-gray-500">Tambah</button>
                            <button v-else="form.kategori.length" @click="updateKategori(idUpdated)" type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 sm:ml-3 sm:w-auto disabled:bg-gray-500">Update</button>
                            <button @click="cancelModal" type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script setup>
import Layout from '@/Layout/Dashboard/DashboardLayout.vue';
import CategoryCard from '@/Components/Global/CategoryCard.vue';
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    kategori: Array
})

const form = useForm({
    kategori: ""
})

function deleteKategori(id) {
    Swal.fire({
        title: "Yakin?",
        text: "Anda yakin ingin menghapus kategori ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm",
        reverseButtons : true
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('kategori.delete', id), {
                // onSuccess: Swal.fire({
                //     title: "Berhasil!",
                //     text: "Kategori Berhasil Di Delete.",
                //     icon: "success"
                // })
            })
        }
    });
}
function editKategori(id) {
    const a = props.kategori.findIndex((kat) => id == kat.id);
    form.kategori = props.kategori[a].kategori
    idUpdated.value = props.kategori[a].id
    console.log(idUpdated.value)
    toggleModal()
}

function updateKategori(id) {
    Swal.fire({
        title: "Yakin?",
        text: "Anda yakin ingin mengupdate kategori ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm"
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(id);
            form.patch(route('kategori.update' , id) , {
                onSuccess : () => {
                    form.reset()
                    toggleModal()
                }
            });
        }
    });
}

const isModal = ref(false);
const idUpdated = ref(null);
function toggleModal() {
    isModal.value = !isModal.value
}

function cancelModal() {
    isModal.value = !isModal.value
    form.reset()
}
</script>
<style scoped></style>
