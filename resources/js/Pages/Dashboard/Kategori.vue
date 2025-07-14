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

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 sm:gap-8">
                <CategoryCard v-for="a in 10" href="#" img="https://cdn-icons-png.flaticon.com/512/2920/2920063.png"
                    name="Web Developer" />
            </div>
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
                                            <label for="kategori" class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                                            <input id="kategori" v-model="form.kategori" type="text" autocomplete="off"
                                                required
                                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button @click="submit" type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 sm:ml-3 sm:w-auto disabled:bg-gray-500">Tambah</button>
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
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    kategori : ""
})

const isModal = ref(false);
function toggleModal() {
    isModal.value = !isModal.value
}

function cancelModal() {
    isModal.value = !isModal.value
    form.reset()
}
</script>
<style scoped></style>
