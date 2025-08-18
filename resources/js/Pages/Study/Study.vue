<template>
    <div class="flex min-h-screen bg-gray-100 font-sans">
        <header class="w-full fixed top-0 left-0 z-40 bg-white py-4 px-6 flex items-center shadow-sm lg:hidden">
            <button @click="toggleSidebar" class="p-2 -ml-2 text-gray-600 hover:text-blue-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-lg font-semibold text-gray-800 ml-4 truncate">{{ course.title_course }}</h1>
        </header>

        <aside
            :class="['w-80 bg-white shadow-lg p-6 overflow-y-auto h-screen fixed left-0 top-0 border-r pt-8 transform transition-transform duration-300 ease-in-out z-20', { '-translate-x-full lg:translate-x-0': isSidebarHidden }]">
            <div class="px-4 py-6 border-b">
                <h2 class="text-2xl font-bold text-blue-600 truncate hidden lg:block">{{ course.title_course }}</h2>
                <p class="text-sm text-gray-500 mt-12 lg:mt-0">Daftar Sesi</p>
            </div>
            <div class="space-y-4 py-4">
                <div class="relative" v-for="value,index in course.course_sessions">
                    <button @click="toggleDropdown(value.session_name)"
                        class="toggle-module w-full text-left font-bold text-lg flex items-center justify-between transition-colors duration-200">
                        <span class="text-sm">Sesi {{ index + 1 }} : {{ value.session_name }}</span>
                        <i
                            :class="['fas fa-chevron-down text-sm transition-transform duration-300', { 'rotate-180': expandedDropdown === value.session_name }]"></i>
                    </button>
                    <div v-if="expandedDropdown === value.session_name" class="ml-4 mt-2 space-y-2">
                        <div v-if="value.material" class="px-4 py-2 border-l-2 border-blue-500 rounded-md">
                            <h4 class="text-sm font-semibold text-gray-700">Materi</h4>
                            <ul class="mt-1 space-y-1">
                                <li><a href="#" @click="loadData(data)" v-for="data, index in value.material" class="sub-module-link mb-2"> {{
                                        index + 1 }}. {{ data.title }}</a></li>
                            </ul>
                        </div>
                        <!-- <div v-if="value.assignment" class="px-4 py-2 border-l-2 border-purple-500 rounded-md">
                            <h4 class="text-sm font-semibold text-gray-700">Tugas</h4>
                            <ul class="mt-1 space-y-1">
                                <li><a href="#" class="sub-module-link">1. Tugas HTML Dasar</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </aside>
        <main
            :class="['flex-1 p-8 space-y-8 pt-24 transition-all duration-300 ease-in-out', { 'lg:ml-80': !isSidebarHidden }]">
            <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl min-h-screen">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                    <div class="fadeIn" v-if="loadedData">
                        {{ loadedData.title }}
                    </div>
                    <div class="fadeIn" v-else>Selamat Datang di Kursus {{ course.title_course }}</div>
                </h1>
                <div v-if="loadedData" class="prose max-w-none" v-html="loadedData.content ? loadedData.content : ''">
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    course: Object
})

const expandedDropdown = ref(null);
const isSidebarHidden = ref(true);
const loadedData = ref(null);

const toggleDropdown = (sessionName) => {
    expandedDropdown.value = expandedDropdown.value === sessionName ? null : sessionName;
    loadedData.value = null
};

const loadData = (data) => {
    loadedData.value = data
    console.log(data)
}

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
