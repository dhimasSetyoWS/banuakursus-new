<template>
    <Head title="Login"/>
    <div class="bg-slate-100">
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
                <div class="text-center mb-8">
                    <a :href="route('beranda')" class="flex justify-center">
                        <img src="/img/banuacourse-icon.png" alt="Banua Kursus" width="100" />
                    </a>
                    <p class="text-slate-500 mt-2">Selamat datang kembali!</p>
                </div>

                <form @submit.prevent="submit" method="POST" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                        <span class="mb-2 text-red-600">{{ form.errors.email }}</span>
                        <div class="mt-1">
                            <input id="email" v-model="form.email" type="email" autocomplete="email" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <span class="mb-2 text-red-600">{{ form.errors.password }}</span>
                        <div class="mt-1">
                            <input id="password" v-model="form.password" type="password" autocomplete="current-password"
                                required
                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-slate-900">Ingat saya</label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Lupa password?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Masuk
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    Belum punya akun?
                    <a :href="route('register')" class="font-medium text-blue-600 hover:text-blue-500">Daftar di
                        sini</a>
                </p>
            </div>
        </div>
    </div>
    <FlashMessage/>
</template>
<script setup>

import { useForm } from '@inertiajs/vue3';
import FlashMessage from '@/Components/Global/FlashMessage.vue';

const form = useForm({
    email : '',
    password : ''
})

function submit() {
    form.post(route('login.post'))
}
</script>
<style scoped></style>
