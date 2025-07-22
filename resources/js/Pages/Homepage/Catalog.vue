<template>
    <HomeLayout :canLogin="canLogin" :canRegister="canRegister" title="Catalog">
        <main class="max-w-[1200px] mx-auto px-6 py-20 fade-up">
            <section class="mb-24 max-w-3xl mx-auto text-left sm:text-center">
                <h2 class="font-poppins font-extrabold text-5xl text-[#1e293b] mb-4 leading-tight">Katalog <span
                        class="text-[#2563eb]">Kursus</span></h2>
                <p class="text-[#475569] text-lg leading-relaxed max-w-2xl mx-auto">
                    Banua Kursus menyediakan berbagai kelas untuk mengembangkan skill Anda, mulai dari teknologi,
                    bahasa, kreativitas, hingga pengembangan diri. Temukan kelas yang tepat untuk meningkatkan kemampuan
                    Anda!
                </p>
            </section>
            <section id="courses" class="mt-8 mb-20">
                <h3
                    class="font-poppins font-semibold text-2xl text-black mb-8 border-b-4 border-black inline-block pb-2">
                    Jelajahi Kategori
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 sm:gap-8">
                    <CategoryCard v-for="a in kategori"
                        :class="c_search == a.slug ? 'outline outline-blue-600 rounded-[1rem]' : ''"
                        @click="category_search(a.slug)" href="javascript:" :name="a.kategori" />
                </div>
            </section>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                <h3
                    class="font-poppins font-semibold text-2xl text-black border-b-4 border-black inline-block pb-2 mb-4 sm:mb-0">
                    Terbaru Dirilis
                </h3>
                <div class="relative w-full sm:w-1/3">
                    <input type="text" placeholder="Cari kursus..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border-2 border-gray-400 focus:outline-none focus:border-blue-500 transition-colors duration-200"
                        v-model="searchQuery">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <Link v-if="courses.data.length" v-for="a in courses.data" :href="route('course', a.slug)"
                    class="block bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="relative">
                    <img src="https://placehold.co/1280x720/000000/ffffff?text=kursus" class="w-full h-[200px] object-cover"
                        alt="Belajar Vue.js Dasar" />
                    <span v-if="a.kategori" class="mt-1 py-0.5 px-2 text-white self-center text-xs absolute top-0 right-0 mx-1 bg-blue-600 rounded-full">{{a.kategori.kategori}}</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ a.title_course }}</h3>
                    <div class="text-base font-bold text-blue-600">{{ formatPrice(a.price) }}</div>
                </div>
                </Link>
                <div v-else>
                    <p class="text-lg font-bold">Tidak ada kursus !</p>
                </div>
            </div>
            <Pagination :links="courses.links" />
        </main>
    </HomeLayout>
</template>

<script setup>
import Pagination from "@/Components/Global/Pagination.vue"
import HomeLayout from '../../Layout/Homepage/HomeLayout.vue';
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";
import CategoryCard from "@/Components/Global/CategoryCard.vue"

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    courses: Object,
    search: String,
    kategori: Array,
    c_search: String
})

function category_search(c) {
    if (props.c_search === c) {
        c = null;
    }
    router.get(route('catalog'),
        {
            ...(props.search ? { search: props.search } : {}),
            category: c
        },
        { preserveState: true, preserveScroll: true })
}

const searchQuery = ref(props.search)

watch(searchQuery,
    debounce((q) => router.get(route('catalog'),
        {
            search: q,
            ...(props.c_search ? { category: props.c_search } : {})
        }, { preserveState: true, preserveScroll: true }
    ), 200) // debounce dari lodash akan mengeksekusi code setelah kita berhenti menginput di input field
    // jadi kan kalau kita cuman pakai watch dia akan jalankan callback function setiap kali ada perubahan pada parameter pertama, yakni searchQuery, nah dengan kita gunakan debouunce, maka itu tidak akan terjadi
);

const formatter = new Intl.NumberFormat('id-ID', {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0
});

function formatPrice(price) {
    return formatter.format(price)
}
</script>

<style scoped>
/* Tambahkan styling di sini jika diperlukan */
.fade-up {
    animation: fadeUp 0.8s ease-in-out both;
}

@keyframes fadeUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

body {
    font-family: "Inter", sans-serif;
    background-color: white;
    min-height: 100vh;
    color: #1e293b;
}

h1,
h2 {
    font-family: "Poppins", sans-serif;
}

/* Popular Category & Tools base style */
.interactive-card {
    background-color: #f6fafa;
    /* very light blue-white */
    border-radius: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
}

.interactive-card:hover,
.interactive-card:focus-visible {
    border-color: #2563eb;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
    outline: none;
}

/* Popular Category and Tools inner spacing */
.category-card,
.tool-card {
    padding: 1.5rem 1.75rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

/* Text styling */
.category-text,
.tool-text {
    font-weight: 600;
    font-size: 1.125rem;
    /* text-lg */
    line-height: 1.3;
    color: #1e293b;
    user-select: none;
}

.tool-subtext {
    font-size: 0.75rem;
    /* text-xs */
    color: #94a3b8;
    user-select: none;
    margin-top: 0.125rem;
}

/* Footer */
footer {
    color: #64748b;
    font-size: 0.875rem;
    user-select: none;
}
</style>
