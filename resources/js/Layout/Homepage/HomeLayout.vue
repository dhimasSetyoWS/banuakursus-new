<template>
    <Head :title="title"/>
    <Navbar :canLogin="canLogin" :canRegister="canRegister"/>
    <slot/>
    <FlashMessage/>
</template>
<script setup>
import Navbar from '../../Components/Homepage/Navbar.vue';
import FlashMessage from '../../Components/Global/FlashMessage.vue';
defineProps({
    canLogin : Boolean,
    canRegister : Boolean,
    title : String
})
</script>
<style scoped></style>
