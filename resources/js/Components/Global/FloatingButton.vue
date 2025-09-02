<template>
    <div
        class="flex flex-col w- items-center justify-center m-12 fixed bottom-0 right-0 bg-black rounded-full p-2 shadow">
        <Transition>
            <div class="bg-white transition-all duration-500 ease-in-out overflow-hidden rounded-full flex flex-col text-secondary" :class="isPressed ? 'h-16 md:h-24' : 'h-0 w-0 opacity-0'">
                <a href="#" class="p-1 lg:p-2">
                    <i class="fa-brands fa-whatsapp fa-lg font-bold"></i>
                </a>
                <a href="#" class="p-1 lg:p-2">
                    <i class="fa-brands fa-instagram fa-lg font-bold"></i>
                </a>
            </div>
        </Transition>
            <button class="p-1 lg:p-2" type="button" @click="isPressed = !isPressed">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-white transition-all font-bold" :class="{ 'rotate-180': isPressed }">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const isPressed = ref(false);
</script>
