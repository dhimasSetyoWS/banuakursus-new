<template>
    <Layout title="Edit Exam">
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
            <h1 class="text-3xl font-bold text-slate-800 mt-2">Edit Exam</h1>
            <p class="text-slate-500">Silahkan edit exam untuk sesi.</p>
        </div>
        <form>
            <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm h-full space-y-2 my-3">
                <div class="shadow border border-slate-300 p-3 my-3 rounded-lg"
                    v-for="(question, qIndex) in 2" :key="qIndex">
                    <label>Pertanyaan {{ qIndex + 1 }}: </label>
                    <input
                        class="mt-1 w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" />
                    <div v-for="(answer, aIndex) in 3" :key="aIndex" class="space-y-2 mb-3">
                        <input type="radio" class="me-3" :name="`correct_answer_${qIndex}`" :value="aIndex"/>
                        <input
                            class="mt-1 w-1/2 px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            type="text" />
                    </div>
                    <button
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        type="button">Tambah Jawaban</button>
                </div>
            </div>
        </form>
    </Layout>
</template>
<script setup>
import Layout from "@/Layout/Dashboard/DashboardLayout.vue";

defineProps({
    session: Object
});
</script>
<style scoped></style>
