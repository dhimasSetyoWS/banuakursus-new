<template>
</template>
<script setup>
import { usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


const page = usePage();

router.on('finish', () => {
    // Ketika navigasi Inertia selesai, periksa flash data yang baru
    const flash = page.props.flash;

    console.log('Inertia Navigation Finished. Checking flash data:', flash); // Debug ini

    if (flash.success) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: flash.success,
            timer: 2200,
            timerProgressBar: true,
            showConfirmButton: true,
        });
        page.props.flash.success = null;
    }

    if (flash.error) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: flash.error,
            timer: 2200,
            timerProgressBar: true,
            showConfirmButton: false,
        });
        page.props.flash.error = null;
    }

    if (flash.message) {
        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: flash.message,
            timer: 2200,
            timerProgressBar: true,
            showConfirmButton: true,
        });
        page.props.flash.message = null;
    }
});

</script>
<style scoped></style>
