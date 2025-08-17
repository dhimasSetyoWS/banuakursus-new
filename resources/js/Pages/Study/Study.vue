<template>
    <div class="flex min-h-screen bg-gray-100 font-sans">
        <header class="w-full fixed top-0 left-0 z-40 bg-white py-4 px-6 flex items-center shadow-sm lg:hidden">
            <button @click="toggleSidebar" class="p-2 -ml-2 text-gray-600 hover:text-blue-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-lg font-semibold text-gray-800 ml-4 truncate">Frontend Dasar</h1>
        </header>

        <aside
            :class="['w-80 bg-white shadow-lg p-6 overflow-y-auto h-screen fixed left-0 top-0 border-r pt-4 transform transition-transform duration-300 ease-in-out z-20', { '-translate-x-full lg:translate-x-0': isSidebarHidden }]">
            <div class="px-4 py-6 border-b">
                <h2 class="text-2xl font-bold text-blue-600 truncate">{{ course.title_course }}</h2>
                <p class="text-sm text-gray-500">Daftar Sesi</p>
            </div>
            <div class="space-y-4 py-4">
                <div class="relative" v-for="value in course.course_sessions">
                    <button @click="toggleDropdown(value.session_name)"
                        class="toggle-module w-full text-left font-bold text-lg flex items-center justify-between transition-colors duration-200">
                        <span>Sesi 1: Pengenalan</span>
                        <i
                            :class="['fas fa-chevron-down text-sm transition-transform duration-300', { 'rotate-180': expandedDropdown === value.session_name }]"></i>
                    </button>
                    <div v-if="expandedDropdown === value.session_name" class="ml-4 mt-2 space-y-2">
                        <div v-if="value.material" class="px-4 py-2 border-l-2 border-blue-500 rounded-md">
                            <h4 class="text-sm font-semibold text-gray-700">Materi</h4>
                            <ul class="mt-1 space-y-1">
                                <li><a href="#" v-for="data, index in value.material" class="sub-module-link mb-2"> {{
                                        index + 1 }}. Materi</a></li>
                            </ul>
                        </div>
                        <div v-if="value.assignment" class="px-4 py-2 border-l-2 border-purple-500 rounded-md">
                            <h4 class="text-sm font-semibold text-gray-700">Tugas</h4>
                            <ul class="mt-1 space-y-1">
                                <li><a href="#" class="sub-module-link">1. Tugas HTML Dasar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <button @click="toggleDropdown('session2')"
                        class="toggle-module w-full text-left font-bold text-lg flex items-center justify-between transition-colors duration-200">
                        <span>Sesi 2: Flexbox</span>
                        <i
                            :class="['fas fa-chevron-down text-sm transition-transform duration-300', { 'rotate-180': expandedDropdown === 'session2' }]"></i>
                    </button>
                    <div v-if="expandedDropdown === 'session2'" class="ml-4 mt-2 space-y-2">
                        <div class="px-4 py-2 border-l-2 border-blue-500 rounded-md">
                            <h4 class="text-sm font-semibold text-gray-700">Materi</h4>
                            <ul class="mt-1 space-y-1">
                                <li><a href="#" class="sub-module-link">1. Penggunaan Flexbox</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <main
            :class="['flex-1 p-8 space-y-8 pt-24 transition-all duration-300 ease-in-out', { 'lg:ml-80': !isSidebarHidden }]">
            <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl min-h-screen">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Pengantar HTML</h1>
                <div class="prose max-w-none">
                    <p>Selamat datang di materi pertama! Di sini kita akan belajar dasar-dasar HTML...</p>
                    <h2 class="text-xl font-semibold mt-6 mb-2">Struktur Dasar HTML</h2>
                    <p>Setiap dokumen HTML memiliki struktur dasar sebagai berikut:</p>
                    <pre><code class="language-html">&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;Judul Halaman&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Hello World&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ButtonEdit from "@/Components/Global/ButtonEdit.vue";

defineProps({
    course: Object
})

const expandedDropdown = ref(null);
const isSidebarHidden = ref(true);

const toggleDropdown = (sessionName) => {
    expandedDropdown.value = expandedDropdown.value === sessionName ? null : sessionName;
    console.log(sessionName)
};

const toggleSidebar = () => {
    isSidebarHidden.value = !isSidebarHidden.value;
};

// Lifecycle hook untuk mengatur status sidebar berdasarkan ukuran layar
onMounted(() => {
    const handleResize = () => {
        // Jika layar lebih besar dari 'lg' (1024px), sidebar selalu terlihat
        if (window.innerWidth >= 1024) {
            isSidebarHidden.value = false;
        } else {
            isSidebarHidden.value = true;
        }
    };

    handleResize(); // Panggil saat komponen pertama kali dimuat
    window.addEventListener('resize', handleResize); // Tambahkan event listener untuk resize

    // Bersihkan event listener saat komponen dilepas
    // return () => {
    //     window.removeEventListener('resize', handleResize);
    // };
});
</script>

<style scoped>
/* CSS Tambahan untuk Tampilan */
.sub-module-link {
    @apply block px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200;
}

.sub-module-link.active {
    @apply bg-blue-200 text-blue-800 font-semibold;
}

.toggle-module {
    @apply p-3 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors duration-200;
}
</style>
