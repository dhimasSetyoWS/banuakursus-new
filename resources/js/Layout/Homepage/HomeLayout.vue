<template>
    <Head :title="title"/>
    <Navbar :canLogin="canLogin" :canRegister="canRegister"/>
    <slot></slot>
    <FlashMessage/>
    <Footer/>
    <!-- <FloatingButton/> -->
</template>
<script setup>
// import FloatingButton from '@/Components/Global/FloatingButton.vue';
import Navbar from '../../Components/Homepage/Navbar.vue';
import FlashMessage from '../../Components/Global/FlashMessage.vue';
import Footer from '../../Components/Homepage/Footer.vue';
defineProps({
    canLogin : Boolean,
    canRegister : Boolean,
    title : String
})
</script>
<style scoped></style>
