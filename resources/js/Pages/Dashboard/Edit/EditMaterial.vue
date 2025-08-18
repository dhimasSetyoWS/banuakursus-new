<template>
    <Layout title="Buat Materi">
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
                <h1 class="text-3xl font-bold text-slate-800 mt-2">Edit Materi</h1>
                <p class="text-slate-500">Silahkan edit materi untuk sesi.</p>
            </div>

            <form @submit.prevent="submit" class="space-y-8">
                <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm h-full">
                    <div class="text-sm text-slate-800 mb-6 space-y-2">
                        <h2 class="font-semibold">Informasi Dasar</h2>
                        <input type="text" v-model="form.title" id="material_title"
                                    placeholder="Masukkan judul material"
                                    class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    autocomplete="off">
                    </div>
                    <div class="space-y-6">
                        <div class="h-full">
                            <label for="description" class="ps-1 block text-sm font-semibold text-slate-700 mb-1">Isi
                                Materi</label>
                            <Alert v-if="form.errors.material" :text="form.errors.material" type="danger" />
                            <QuillEditor v-model:content="form.material" style="height:200px;" contentType="html" toolbar="full">
                            </QuillEditor>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end items-center gap-4">
                    <a :href="route('session.edit', session.id)"
                        class="px-6 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Edit Materi</button>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup>
import Alert from "@/Components/Global/Alert.vue";
import Layout from "@/Layout/Dashboard/DashboardLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    session: Object,
    material : Object
})

const form = useForm({
    title : props.material.title,
    material: props.material.content
});

function submit() {
    form.patch(route('material.update',  [props.session.id , props.material.id]));
}

</script>
<style scoped></style>
