<template>

    <Head title="Study" />
    <nav class="w-full fixed top-0 left-0 z-40 bg-white py-3 sm:py-6 px-6 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-4">
            <button @click="toggleSidebar" class="p-2 -ml-2 text-gray-600 hover:text-blue-600 lg:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-lg font-semibold text-gray-800 hidden md:block cursor-default">{{ course.title_course }}
            </h1>
        </div>
        <div class="flex items-center gap-6">
            <a :href="route('mycourse')"
                class="text-blue-600 font-semibold hover:text-blue-800 transition text-sm md:text-lg flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </nav>

    <aside
        :class="['w-80 bg-white shadow-lg p-6 overflow-y-auto h-screen fixed left-0 top-0 border-r pt-24 transform transition-transform duration-300 ease-in-out lg:transform-none z-10', { '-translate-x-full': isSidebarHidden }]">
        <h2 @click="activeItem = null" class="text-2xl font-bold mb-6 text-center text-blue-600 cursor-pointer truncate"
            :title="course.title_course">
            Daftar Session
            <hr class="mt-2">
        </h2>
        <div class="space-y-4">
            <div v-if="checkGroupSession()">
                <div v-for="(session, sessionName) in groupedSessions" :key="sessionName">
                    <div class="ml-4 mt-2 space-y-2">
                        <button v-for="item in session.items" :key="item.id" @click="loadItem(item)"
                            :class="['w-full text-left sub-module flex items-center', { 'active': activeItem && item.id === activeItem.id }]">
                            <i
                                :class="['w-4 text-center', item.kategori === 'artikel' ? 'fa-solid fa-file-lines' : 'fa-solid fa-clipboard-list']"></i>
                            <span class="ml-2">{{ item.kategori === 'artikel' ? item.artikel.judul :
                                item.tugas.nama_tugas
                                }}</span>
                        </button>
                    </div>
                </div>
            </div>
            <div v-else class="flex items-center rounded bg-indigo-500 text-white text-sm font-bold px-4 py-3 cursor-default" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>Saat ini belum ada session.</p>
            </div>
        </div>
    </aside>

    <div
        :class="['flex-1 p-8 space-y-8 pt-24 transition-all duration-300 ease-in-out', { 'lg:ml-80': !isSidebarHidden }]">
        <div v-if="activeItem" class="bg-white p-6 md:p-10 rounded-2xl shadow-xl min-h-screen">
            <div v-if="activeItem.kategori === 'artikel'">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ activeItem.artikel.judul }}</h1>
                <div class="article-content prose" v-html="activeItem.artikel.konten"></div>
            </div>
            <div v-else-if="activeItem.kategori === 'tugas'">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">{{ activeItem.tugas.title }}</h1>
                <p class="text-sm text-gray-500 mb-6">Tenggat: {{ new
                    Date(activeItem.tugas.tenggat_waktu).toLocaleDateString('id-ID', {
                        weekday: 'long', year: 'numeric',
                        month: 'long', day: 'numeric'
                    }) }}</p>
                <div class="article-content" v-html="activeItem.tugas.isi_tugas"></div>
            </div>
        </div>

        <div v-else
            class="text-center text-gray-500 py-20 bg-white rounded-2xl shadow-xl flex flex-col items-center justify-center z-0">
            <i class="fas fa-hand-point-left text-6xl text-blue-400 mb-6 animate-pulse z-0"></i>
            <p class="text-2xl font-semibold text-gray-700">Selamat Datang di Kursus {{ course.title_course }}!</p>
            <p>Pilih materi atau tugas dari sidebar untuk memulai.</p>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue'; // <-- Pastikan nextTick diimpor

const props = defineProps({
    course: Object,
});

// --- State untuk UI ---
const isSidebarHidden = ref(true);
const activeItem = ref(null);
const moduleExpandedState = ref({});

// --- Computed Property untuk mengelompokkan data ---
const groupedSessions = computed(() => {
    if (!props.course || !props.course.course_sessions) {
        return {};
    }
    return props.course.course_sessions.reduce((acc, item) => {
        const sessionName = item.session_name;
        if (!acc[sessionName]) {
            acc[sessionName] = { items: [] };
        }
        acc[sessionName].items.push(item);
        return acc;
    }, {});
});

function checkGroupSession() {
    if (props.course.course_sessions.length > 0) {
        return true
    } else {
        return false
    }
}

// --- Methods untuk Interaktivitas ---
const loadItem = (item) => {
    activeItem.value = item;

    if (window.innerWidth < 1024) {
        isSidebarHidden.value = true;
    }

    // <-- TAMBAHAN: Tunggu DOM update, lalu scroll ke atas
    nextTick(() => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
};

const toggleModule = (sessionName) => {
    moduleExpandedState.value[sessionName] = !moduleExpandedState.value[sessionName];
};

const toggleSidebar = () => {
    isSidebarHidden.value = !isSidebarHidden.value;
};

// --- Lifecycle Hook ---
onMounted(() => {
    const handleResize = () => {
        if (window.innerWidth < 1024) {
            isSidebarHidden.value = true;
        } else {
            isSidebarHidden.value = false;
        }
    };
    handleResize();
    window.addEventListener('resize', handleResize);

    const firstSessionName = Object.keys(groupedSessions.value)[0];
    if (firstSessionName) {
        moduleExpandedState.value[firstSessionName] = true;
    }
});
</script>

<style>
/* CSS tetap sama, tidak perlu diubah */


body {
    font-family: "Inter", sans-serif;
    background-color: #f8fafc;
}

.article-content h1,
.article-content h2,
.article-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
}

.article-content p {
    margin-bottom: 1rem;
    line-height: 1.7;
}

.article-content ul,
.article-content ol {
    list-style-position: inside;
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.article-content strong,
.article-content b {
    font-weight: 700;
}

.article-content em,
.article-content i {
    font-style: italic;
}

.article-content pre {
    background-color: #f3f4f6;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    white-space: pre-wrap;
}

.article-content iframe {
    width: 100%;
    height: auto;
    aspect-ratio: 16 / 9;
    border-radius: 0.75rem;
}

.toggle-module {
    padding: 12px 15px;
    border-radius: 8px;
    background-color: #f1f5f9;
    color: #334155;
}

.toggle-module:hover {
    background-color: #e2e8f0;
}

.sub-module {
    padding: 10px 15px;
    border-radius: 6px;
    color: #475569;
}

.sub-module:hover {
    background-color: #e0f2fe;
    color: #0c4a6e;
}

.sub-module.active {
    background-color: #bfdbfe;
    font-weight: 600;
    color: #1e40af;
}

.bg-white {
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}
</style>
