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
                    class="mb-1 mr-1 px-4 py-3 text-sm leading-4 hover:bg-[#EE3D3B] hover:text-black border focus:border-gray-600 rounded"
                    :class="{ 'bg-[#630BD1] text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});
</script>
