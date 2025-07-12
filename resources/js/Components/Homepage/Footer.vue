<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer class="bg-gray-900 text-gray-300 py-16 px-6 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice" fill="none" stroke="currentColor" stroke-width="0.1" stroke-opacity="0.1">
                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <path d="M10 0L0 0 0 10"/>
                </pattern>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        <div class="container mx-auto max-w-[1200px] relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12 lg:gap-x-16">
                <div class="space-y-4">
                    <h3 class="text-3xl font-extrabold text-white tracking-tight leading-none">Banua <span class="text-blue-500">Kursus</span></h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Platform edukasi online terdepan untuk pengembangan sumber daya manusia yang relevan dengan kebutuhan industri.
                    </p>
                    <Link :href="route('catalog')" class="inline-flex items-center px-6 py-3 mt-4 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors duration-300 shadow-md hover:shadow-lg">
                        Jelajahi Kursus
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </Link>
                </div>

                <div>
                    <h4 class="font-semibold text-white text-lg mb-5 border-b border-blue-600 pb-2">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><Link :href="route('aboutus')" class="text-gray-400 hover:text-white transition-colors duration-200 text-sm">Tentang Kami</Link></li>
                        <li><Link :href="route('catalog')" class="text-gray-400 hover:text-white transition-colors duration-200 text-sm">Katalog Kursus</Link></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200 text-sm">Mitra & Instruktur</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200 text-sm">Blog & Berita</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200 text-sm">Karier</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold text-white text-lg mb-5 border-b border-blue-600 pb-2">Dukungan</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Pusat Bantuan (FAQ)</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Syarat & Ketentuan</a></li>
                        <li><a href="mailto:halo@banuakursus.com" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5.5C2.5 5.22386 2.72386 5 3 5H21C21.2761 5 21.5 5.22386 21.5 5.5V18.5C21.5 18.7761 21.2761 19 21 19H3C2.72386 19 2.5 18.7761 2.5 18.5V5.5ZM20 6.5L12 11.5L4 6.5V17.5H20V6.5Z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                            halo@banuakursus.com
                        </a></li>
                        <li><a href="tel:+6281234567890" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6.07 9.87321C4.30132 8.10452 3.10901 6.59802 3.01309 6.47196C2.91973 6.34825 2.89885 6.22329 2.8808 6.09673C2.86275 5.97017 2.85376 5.86178 2.85376 5.76296C2.85376 5.66415 2.86275 5.55575 2.8808 5.42919C2.89885 5.30263 2.91973 5.17767 3.01309 5.05396C3.10901 4.92789 4.30132 3.4214 6.07 1.65271C6.95368 0.769024 7.50209 0.220612 8.04944 0.220612C8.59678 0.220612 9.07185 0.509706 9.49755 1.09627C9.92326 1.68283 10.3697 2.37877 10.8252 3.08316C11.3912 3.96684 11.7779 4.65431 11.9686 5.06821C12.1593 5.48211 12.2854 5.90382 12.3486 6.33333C12.4118 6.76285 12.4286 7.18247 12.4286 7.59212C12.4286 8.00177 12.4118 8.42139 12.3486 8.85091C12.2854 9.28042 12.1593 9.70214 11.9686 10.116C11.7779 10.5299 11.3912 11.2174 10.8252 12.1011C10.3697 12.8055 9.92326 13.5014 9.49755 14.088C9.07185 14.6746 8.59678 14.9637 8.04944 14.9637C7.50209 14.9637 6.95368 14.4153 6.07 13.5316C4.30132 11.7629 3.10901 10.2564 3.01309 10.1303C2.91973 10.0066 2.89885 9.88164 2.8808 9.75508C2.86275 9.62852 2.85376 9.52013 2.85376 9.42131C2.85376 9.3225 2.86275 9.2141 2.8808 9.08754C2.89885 8.96098 2.91973 8.83602 3.01309 8.71231C3.10901 8.58625 4.30132 7.07976 6.07 5.31107C7.75108 3.63001 8.84752 2.53357 9.94396 1.43713C10.6483 0.761066 10.9701 0.44857 11.2828 0.135832L11.2828 0.135832L11.2828 0.135832ZM12.7172 23.8642C12.7172 23.8642 12.7172 23.8642 12.7172 23.8642C13.8136 22.7678 14.9101 21.6713 16.5911 19.9903C18.3698 18.2116 19.5621 16.7051 19.6581 16.579C19.754 16.4553 19.7749 16.3303 19.7929 16.2038C19.811 16.0772 19.82 15.9688 19.82 15.87C19.82 15.7712 19.811 15.6628 19.7929 15.5362C19.7749 15.4097 19.754 15.2847 19.6581 15.161C19.5621 15.0349 18.3698 13.5284 16.5911 11.7598C14.9101 10.0807 13.8136 8.98428 12.7172 7.88784C12.0411 7.18345 11.7286 6.86095 11.416 6.54821L11.416 6.54821L11.416 6.54821C10.9903 6.13608 10.5152 5.84698 9.96784 5.84698C9.4205 5.84698 8.84078 6.13608 8.30514 6.54821L8.30514 6.54821L8.30514 6.54821C7.8806 7.13477 7.43415 7.83071 6.97864 8.5351C6.41261 9.41879 6.02592 10.1063 5.83522 10.5202C5.64452 10.9341 5.51846 11.3558 5.45522 11.7853C5.39198 12.2148 5.37522 12.6345 5.37522 13.0441C5.37522 13.4538 5.39198 13.8734 5.45522 14.303C5.51846 14.7325 5.64452 15.1542 5.83522 15.5681C6.02592 15.982 6.41261 16.6695 6.97864 17.5532C7.43415 18.2576 7.8806 18.9535 8.30514 19.54C8.72969 20.1266 9.20476 20.4157 9.7521 20.4157C10.3006 20.4157 10.7757 20.1266 11.2002 19.54C11.6248 18.9535 12.0712 18.2576 12.5268 17.5532C13.0928 16.6695 13.4795 15.982 13.6702 15.5681C13.8609 15.1542 13.987 14.7325 14.0502 14.303C14.1135 13.8734 14.1302 13.4538 14.1302 13.0441C14.1302 12.6345 14.1135 12.2148 14.0502 11.7853C13.987 11.3558 13.8609 10.9341 13.6702 10.5202C13.4795 10.1063 13.0928 9.41879 12.5268 8.5351C12.0712 7.83071 11.6248 7.13477 11.2002 6.54821C10.7757 6.13608 10.3006 5.84698 9.7521 5.84698C9.4205 5.84698 9.108 6.13608 8.79532 6.54821L8.79532 6.54821L8.79532 6.54821Z" fill="#000000"></path></svg>
                            +62 812-3456-7890
                        </a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold text-white text-lg mb-5 border-b border-blue-600 pb-2">Lokasi Kami</h4>
                    <address class="not-italic text-sm text-gray-400 leading-relaxed mb-6">
                        <span class="flex items-start">
                            <svg class="w-4 h-4 mr-2 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"></path></svg>
                            Jl. Tadulako Kelurahan No.35, <br>Besusu Tengah Kec. Palu Timur, <br>Sulawesi Tengah, 94112
                        </span>
                    </address>

                    <h4 class="font-semibold text-white text-lg mb-5 border-b border-blue-600 pb-2">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transform hover:scale-110 transition-transform duration-200" aria-label="Ikuti kami di Instagram">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.012 3.584-.07 4.85c-.148 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.012-3.584.07-4.85c.148-3.225 1.664-4.771 4.919-4.919C8.416 2.175 8.796 2.163 12 2.163m0-2.163C8.74 0 8.333.012 7.053.072 2.695.272.273 2.69.073 7.052.012 8.333 0 8.74 0 12s.012 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98C8.333 23.988 8.74 24 12 24s3.667-.012 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98C23.988 15.667 24 15.26 24 12s-.012-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98C15.667.012 15.26 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transform hover:scale-110 transition-transform duration-200" aria-label="Ikuti kami di Facebook">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.23 0H1.77C.79 0 0 .79 0 1.77v20.46C0 23.21.79 24 1.77 24h11.23v-9.3H9.69V11.1h3.31V8.56c0-3.28 1.95-5.09 4.95-5.09 1.42 0 2.94.26 2.94.26v3.08h-1.58c-1.63 0-2.1.97-2.1 2.02v2.44h3.48l-.56 3.6H17v9.3h5.23c.98 0 1.77-.79 1.77-1.77V1.77C24 .79 23.21 0 22.23 0z">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transform hover:scale-110 transition-transform duration-200" aria-label="Ikuti kami di LinkedIn">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.541v-5.524c0-1.31-.023-2.993-1.824-2.993-1.825 0-2.107 1.423-2.107 2.905v5.612H9.435V9h3.413v1.561h.046c.477-.9 1.637-1.854 3.37-1.854 3.602 0 4.267 2.368 4.267 5.455v6.39ZM6.57 6.546A2.477 2.477 0 0 1 4.1 4.07C4.1 2.76 5.176 1.7 6.57 1.7c1.393 0 2.477 1.06 2.477 2.37 0 1.309-1.084 2.369-2.477 2.369Zm-3.541 13.906h3.541V9H3.029v11.452ZM22.225 0H1.771C.792 0 0 .783 0 1.762v20.476C0 23.217.792 24 1.771 24h20.455C23.208 24 24 23.217 24 22.238V1.762C24 .783 23.208 0 22.225 0Z"/>
                            </svg>
                        </a>
                        </div>
                </div>
            </div>

            <div class="mt-20 pt-8 border-t border-gray-700 text-center text-xs text-gray-500">
                <p>&copy; {{ new Date().getFullYear() }} Banua Kursus. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>

<style scoped>
/* Background pattern */
svg pattern path {
    stroke: currentColor;
}
</style>