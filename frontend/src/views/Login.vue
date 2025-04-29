<script setup>
    import GuestLayout from '@/components/GuestLayout.vue'
    import { RouterLink } from 'vue-router'
    import { ref } from 'vue';
    import axiosClient from '../axios';
    import router from '../router';

    const data = ref({
        email: '',
        password: ''
    });

    const errorMessage = ref('');

    function submit(){
        axiosClient.get('/sanctum/csrf-cookie')
            .then(resp => {
                axiosClient.post('/login', data.value)
                    .then(response => {
                        router.push({ name: 'Home' });
                        console.log(response.data);
                    })
                    .catch(error => {
                        errorMessage.value = error.response.data.message;
                    });
            })
    }
</script>

<template>
    <GuestLayout>
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Acesse sua Conta</h2>

        <div v-if="errorMessage" class="mt-4 py-2 px-3 rounded text-white bg-red-400 text-center sm:mx-auto sm:w-full sm:max-w-sm">
            {{ errorMessage }}
        </div>

        <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
        <form @submit.prevent="submit" class="space-y-6">
            <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
            <div class="mt-2">
                <input type="email" name="email" id="email" autocomplete="email" required="" v-model="data.email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
            </div>
            <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Senha</label>
                <div class="text-sm">
                <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Esqueceu a senha?</a>
                </div>
            </div>
            <div class="mt-2">
                <input type="password" name="password" id="password" autocomplete="current-password" required="" v-model="data.password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
            </div>
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Entrar</button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            Não é Membro?
            {{ ' ' }}
            <RouterLink :to="{name: 'Register' }" class="font-semibold text-indigo-600 hover:text-indigo-500">Crie uma Conta</RouterLink>
        </p>
        </div>
    </GuestLayout>
</template>

<style scoped></style>