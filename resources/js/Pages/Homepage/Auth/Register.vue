<template>

    <Head title="Register" />

    <body class="grid min-h-svh lg:grid-cols-2">
        <div class="flex flex-col gap-4 p-6 md:p-10">
            <div class="flex justify-center gap-2">
                <a href="#" class="flex items-center md:gap-2 font-medium">
                    <Link :href="route('beranda')" class="hover:animate-pulse">
                    <img src="img/banuacourse-icon.png" alt="" width="100">
                    </Link>
                </a>
            </div>
            <div class="flex flex-1 items-center justify-center">
                <div class="w-full max-w-lg">
                    <div class="mb-4">
                        <h1 class="text-2xl font-bold">Daftar Sekarang</h1>
                    </div>
                    <form @submit.prevent="submit" method="POST" class="space-y-6">
                        <div class="flex space-x-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                                <span class="mb-2 text-red-600">{{ form.errors.name }}</span>
                                <div class="mt-1">
                                    <input id="name" v-model="form.name" type="text" autocomplete="name" required placeholder="John Doe"
                                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            <div>
                                <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                                <span class="mb-2 text-red-600">{{ form.errors.username }}</span>
                                <div class="mt-1">
                                    <input id="username" v-model="form.username" type="text" required placeholder="Joe"
                                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                            <span class="mb-2 text-red-600">{{ form.errors.email }}</span>
                            <div class="mt-1">
                                <input id="email" v-model="form.email" type="email" autocomplete="email" required placeholder="user@gmail.com"
                                    class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label for="tel_num" class="block text-sm font-medium text-slate-700">No. Telp</label>
                            <span class="mb-2 text-red-600">{{ form.errors.phone_number }}</span>
                            <div class="mt-1">
                                <input id="tel_num" v-model="form.phone_number" type="tel" autocomplete="tel" required placeholder="+628123456789"
                                    class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                                <span class="mb-2 text-red-600">{{ form.errors.password }}</span>
                                <div class="mt-1">
                                    <input id="password" v-model="form.password" type="password" autocomplete="new-password"
                                        required
                                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label for="password-confirm" class="block text-sm font-medium text-slate-700">Konfirmasi
                                    Password</label>
                                <span class="mb-2 text-red-600">{{ form.errors.password_confirmation }}</span>
                                <div class="mt-1">
                                    <input id="password-confirm" v-model="form.password_confirmation" type="password"
                                        autocomplete="new-password" required
                                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Daftar Akun
                            </button>
                        </div>
                    </form>
                    <p class="mt-6 text-center text-sm text-slate-600">
                        Sudah punya akun?
                        <a :href="route('login')" class="font-medium text-blue-600 hover:text-blue-500">Masuk.</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="fadeIn bg-muted relative hidden lg:block">
            <img src="img/auth/register-wp.jpg" alt="Image"
                class="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale" />
        </div>
    </body>
    <FlashMessage />
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import FlashMessage from '../../../Components/Global/FlashMessage.vue';

const form = useForm({
    name: "",
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
})

function submit() {
    form.post(route('register.post'));
}
</script>
<style scoped></style>
