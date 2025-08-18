<template>
    <Head :title="title" />
    <div class="text-slate-800 fadeIn">
        <div class="flex h-screen bg-slate-50">
            <!-- Sidebar -->
            <aside :class="{ 'hidden': navHidden }" class="absolute md:relative h-screen md:h-auto md:block w-64 flex-shrink-0 bg-white border-r border-slate-200 z-[999] md:z-0">
                <div class="flex flex-col h-full">
                    <button @click="showHidden" class="block md:hidden absolute top-3 right-3 p-1 border border-slate-200 rounded-full hover:bg-slate-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                    <div class="h-16 flex items-center justify-center border-b border-slate-200">
                        <Link :href="route('beranda')" class="flex items-center gap-1">
                            <img src="/img/banuacourse-icon-logo.png" alt="Logo Icon" width="35">
                            <img src="/img/banuacourse-icon-title.png" alt="Logo Title" width="45">
                        </Link>
                    </div>

                    <!-- NAVIGASI SIDEBAR YANG SUDAH DI-REFACTOR -->
                    <nav class="flex-1 px-4 py-4 space-y-2">
                        <!-- Tombol Utama Dropdown -->
                        <button @click="toggleMenu" class="flex justify-between items-center w-full px-4 py-2 text-sm font-medium rounded-md hover:bg-slate-100 text-slate-600">
                            <div class="flex items-center">
                                <i class="fas fa-home w-5 h-5 mr-3 text-center"></i>
                                <span>{{ dashboardTitle }}</span>
                            </div>
                            <svg :class="{ 'rotate-180': dropdownMenu }" class="transform transition-transform duration-200 -mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Konten Dropdown yang Dinamis -->
                        <div class="ps-2 space-y-2 overflow-hidden transition-all duration-300 ease-in-out" :class="{ 'max-h-96 opacity-100': dropdownMenu, 'max-h-0 opacity-0': !dropdownMenu }">
                            <Link v-for="link in mainLinks" :key="link.routeName" :href="route(link.routeName, link.params || {})" class="flex items-center px-4 py-2 text-sm font-medium hover:bg-slate-100 rounded-md" :class="isLinkActive(link.activeUrls) ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600'">
                                <i :class="link.icon" class="w-5 h-5 mr-3 text-center"></i>
                                {{ link.name }}
                            </Link>
                        </div>

                        <!-- Link Umum di luar dropdown -->
                        <Link v-for="link in commonLinks" :key="link.routeName" :href="route(link.routeName)" class="flex items-center px-4 py-2 text-sm font-medium hover:bg-slate-100 rounded-md" :class="isLinkActive(link.activeUrls) ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600'">
                            <i :class="link.icon" class="w-5 h-5 mr-3 text-center"></i>
                            {{ link.name }}
                        </Link>
                    </nav>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="h-16 flex items-center justify-between px-6 bg-white border-b border-slate-200">
                    <div class="flex items-center">
                        <!-- Tombol Menu Mobile -->
                        <button @click="showHidden" class="md:hidden mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <!-- Search Bar (jika bukan siswa) -->
                        <div v-if="user.role_id != 4" class="relative hidden md:block">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="text" placeholder="Cari kursus, siswa..." class="w-64 pl-10 pr-4 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-full hover:bg-slate-100">
                            <i class="fas fa-bell text-xl text-slate-500"></i>
                        </button>
                        <!-- Dropdown Profil -->
                        <div class="relative inline-block">
                            <button @click="dropdownToggle" class="flex items-center space-x-2 rounded p-2 hover:bg-slate-100">
                                <img src="https://i.pravatar.cc/150?img=5" alt="Avatar" class="w-9 h-9 rounded-full">
                                <div class="hidden md:block text-sm text-left">
                                    <p class="font-semibold">{{ user.name }}</p>
                                    <p class="text-slate-500">{{ user.email }}</p>
                                </div>
                                <svg :class="{ 'rotate-180': dropdown }" class="transform transition-transform duration-200 -mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div v-show="dropdown" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none dropdown">
                                <div class="py-1">
                                    <Link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-100">Account settings</Link>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-100">Support</a>
                                    <Link :href="route('logout')" method="post" as="button" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-slate-100">Sign out</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Slot untuk konten halaman -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-6">
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
    <FlashMessage />
</template>
<script setup>
import { ref, computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import FlashMessage from "../../Components/Global/FlashMessage.vue";

// --- PROPS & STATE ---
defineProps({
    title: String
});

// State untuk UI
const navHidden = ref(true);
const dropdown = ref(false);
const dropdownMenu = ref(true);

const user = usePage().props.auth.user;

const showHidden = () => navHidden.value = !navHidden.value;
const dropdownToggle = () => dropdown.value = !dropdown.value;
const toggleMenu = () => dropdownMenu.value = !dropdownMenu.value;



// 1. Struktur Data untuk Menu
const adminLinks = [
    { name: 'Beranda', routeName: 'dashboard', activeUrls: ['/dashboard'], icon: 'fas fa-home' },
    { name: 'Manajemen Kursus', routeName: 'manage-course', activeUrls: ['/dashboard/manage-course'], icon: 'fas fa-graduation-cap' },
    { name: 'Guru', routeName: 'teacher', activeUrls: ['/dashboard/teacher'], icon: 'fas fa-chalkboard-teacher' },
    { name: 'Siswa', routeName: 'student', activeUrls: ['/dashboard/student'], icon: 'fas fa-user-graduate' },
    { name: 'Tugas', routeName: 'task', activeUrls: ['/dashboard/task', '/dashboard/task/create'], icon: 'fas fa-tasks' },
    { name: 'Artikel', routeName: 'article', activeUrls: ['/dashboard/article', '/dashboard/article/create'], icon: 'fas fa-newspaper' },
    { name: 'Kategori', routeName: 'kategori', activeUrls: ['/dashboard/kategori', '/dashboard/kategori/create'], icon: 'fas fa-tag' },
];

const teacherLinks = [
    { name: 'Beranda', routeName: 'dashboard', activeUrls: [`/dashboard`], icon: 'fas fa-home' },
    { name: 'Manajemen Kursus', routeName: 'manage-course', activeUrls: [`/dashboard/manage-course`], icon: 'fas fa-graduation-cap' },
    { name: 'Artikel', routeName: 'article', activeUrls: ['/dashboard/article', '/dashboard/article/create'], icon: 'fas fa-newspaper' },
];

const studentLinks = [
    { name: 'My Course', routeName: 'mycourse', activeUrls: ['/dashboard/mycourse'], icon: 'fas fa-book-open' },
    { name: 'Artikel', routeName: 'article', activeUrls: ['/dashboard/article', '/dashboard/article/create'], icon: 'fas fa-newspaper' },
];

const commonLinks = [
    { name: 'Pengaturan Akun', routeName: 'profile.edit', activeUrls: ['/profile'], icon: 'fas fa-cog' },
];

// 2. Computed Properties untuk Logika Dinamis
const dashboardTitle = computed(() => {
    const roles = { 1: 'Dashboard Admin', 2: 'Dashboard Admin', 3: 'Dashboard Guru' };
    return roles[user.role_id] || 'Dashboard Siswa';
});

const mainLinks = computed(() => {
    if (user.role_id === 1 || user.role_id === 2) return adminLinks;
    if (user.role_id === 3) return teacherLinks;
    return studentLinks;
});

// 3. Fungsi Helper
const isLinkActive = (activeUrls) => {
    const currentPath = usePage().url.split('?')[0];
    return activeUrls.includes(currentPath);
};

</script>
<style scoped>
.dropdown {
    animation: fadeIn 0.2s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
