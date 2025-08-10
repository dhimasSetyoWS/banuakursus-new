<template>
    <!-- Cek jika data melebihi dari maksimal per halaman -->

    <div v-if="links.length > 3">
        <div class="flex flex-wrap mt-4">
            <template v-for="(link, key) in links">
                <!-- Jika url nya null atau dalam artian di halaman pertama, dia akan tampilkan code html dari link.label -->
                <div v-if="link.url === null" :key="key"
                    class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded" v-html="link.label" />
                <!-- Jika kondisi di atas tidak memenuhi maka dia akan jalankan kondisi dibawah -->
                <Link v-else :key="`link-${key}`"
                    class="mb-1 mr-1 px-4 py-3 text-sm leading-4 hover:text-white hover:bg-[#4338CA] border focus:border-gray-600 rounded"
                    :class="{ 'bg-[#4338CA] text-white': link.active }" :href="link.url" v-html="link.label"
                    preserve-scroll preserve-state />
            </template>
        </div>
    </div>

    <!-- <div v-if="links.length > 3" class="flex justify-between items-center px-4 py-3">
        <div class="flex space-x-1">
            <template v-for="(link,key) in links">
                <button v-if="link.url === null" :key="key" v-html="link.label"
                    class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-slate-800 border border-slate-800 rounded hover:bg-slate-600 hover:border-slate-600 transition duration-200 ease">
                </button>
                <Link v-else :key="`link-${key}`" v-html="link.label" :href="link.url"
                    class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white border bg-slate-800 border-slate-800 rounded hover:bg-slate-600 hover:border-slate-600 transition duration-200 ease" :class="{'bg-slate-500 border-none' : link.active}">
            </Link>
            </template>
        </div>
    </div> -->
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});
</script>
