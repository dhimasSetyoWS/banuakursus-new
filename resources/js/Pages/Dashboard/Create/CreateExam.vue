<template>
    <Layout title="Buat Exam">
        <div class="mb-6">
            <a :href="route('session.edit', session.id)" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-2 w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                Kembali ke Edit Sesi
            </a>
            <h1 class="text-3xl font-bold text-slate-800 mt-2">Buat Ujian</h1>
            <p class="text-slate-500">Silahkan buat ujian untuk sesi.</p>
        </div>
        <form @submit.prevent="submit">
            <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm h-full space-y-2 my-3">
                <div class="mb-3">
                    <label for="judul_ujian" class="font-semibold">Judul Ujian:</label>
                    <input class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" id="judul_ujian" v-model="form.judul_ujian" />
                </div>
                <div class="mb-3">
                    <div class="flex flex-col">
                        <label for="judul_ujian" class="font-semibold">Jenis Ujian :</label>
                        <select v-model="form.jenis" id="" class="mt-1 w-1/2 px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1">Pilihan Ganda</option>
                            <option value="2">Essay</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">Buat Ujian</button>
            </div>
        </form>
    </Layout>
</template>

<script setup>
import { useForm,router } from '@inertiajs/vue3';
import Layout from '@/Layout/Dashboard/DashboardLayout.vue';

const props = defineProps({
    session : Object
})

// Inisialisasi form state dengan data yang akan dikirim
const form = useForm({
    judul_ujian: '',
    jenis : '',
    questions: [
        {
            text: '',
            answers: [
                { text: '' },
                { text: '' }
            ],
            correct_answer_index: null
        }
    ]
});

// Method untuk menambahkan pertanyaan baru
const addQuestion = () => {
    form.questions.push({
        text: '',
        answers: [{ text: '' }, { text: '' }],
        correct_answer_index: null
    });
};

// Method untuk menambahkan pilihan jawaban pada pertanyaan tertentu
const addAnswer = (qIndex) => {
    form.questions[qIndex].answers.push({ text: '' });
};

// Method yang akan dieksekusi saat form di-submit
const submit = () => {
    router.get(route('exam.edit', props.session.id));
};
</script>
