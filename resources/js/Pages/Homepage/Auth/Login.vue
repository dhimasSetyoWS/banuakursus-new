<template>
    <Head title="Login" />
    <body class="grid min-h-svh lg:grid-cols-2">
        <div class="flex flex-col gap-4 p-6 md:p-10">
            <div class="flex justify-center gap-2">
                <a href="#" class="flex items-center md:gap-2 font-medium">
                    <Link :href="route('beranda')" class="hover:animate-pulse">
                    <img src="img/banuacourse-icon.png" alt="" width="100">
                    </Link>
                </a>
            </div>
            <div class="fadeIn flex flex-1 items-center justify-center">
                <div class="w-full max-w-sm">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold">Masuk ke akun anda</h1>
                        <p class="text-muted-foreground text-sm text-balance">
                            Masukkan email di bawah untuk masuk ke akun anda.
                        </p>
                    </div>
                    <form @submit.prevent="submit" method="POST" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                            <span class="mb-2 text-red-600">{{ form.errors.email }}</span>
                            <div class="mt-1">
                                <input id="email" v-model="form.email" type="email" autocomplete="email" required placeholder="user@gmail.com"
                                    class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <span class="mb-2 text-red-600">{{ form.errors.password }}</span>
                            <div class="mt-1">
                                <input id="password" v-model="form.password" type="password"
                                    autocomplete="current-password" required
                                    class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" v-model="form.isRemember" type="checkbox"
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
        <div class="fadeIn bg-muted relative hidden lg:block">
            <img src="img/auth/login-wp.jpg" alt="Image"
                class="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale" />
        </div>
    </body>
    <FlashMessage />
</template>
<script setup>

import { useForm } from '@inertiajs/vue3';
import FlashMessage from '@/Components/Global/FlashMessage.vue';

const form = useForm({
    email: '',
    password: '',
    isRemember: false
})

function submit() {
    form.post(route('login.post'))
}
</script>
<style scoped></style>
