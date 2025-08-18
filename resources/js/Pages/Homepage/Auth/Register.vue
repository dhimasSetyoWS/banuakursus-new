<template>
    <Head title="Register"/>
    <body class="bg-slate-100">
        <div class="flex items-center justify-center min-h-screen py-12">
            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
                <div class="text-center justify-center mb-8">
                    <a :href="route('beranda')" class="flex justify-center">
                        <img src="/img/banuacourse-icon.png" alt="Banua Kursus" width="100" />
                    </a>
                    <!-- <h1 class="text-2xl font-bold text-slate-800">Buat Akun Baru</h1> -->
                </div>
                <form @submit.prevent="submit" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                        <span class="mb-2 text-red-600">{{ form.errors.name }}</span>
                        <div class="mt-1">
                            <input id="name" v-model="form.name" type="text" autocomplete="name" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                        <span class="mb-2 text-red-600">{{ form.errors.username }}</span>
                        <div class="mt-1">
                            <input id="username" v-model="form.username" type="text" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

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

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Daftar Akun
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    Sudah punya akun?
                    <a :href="route('login')" class="font-medium text-blue-600 hover:text-blue-500">Masuk di sini</a>
                </p>
            </div>
        </div>
    </body>
    <FlashMessage/>
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
