<script setup>
    import GuestLayout from '@/components/GuestLayout.vue'
    import { RouterLink } from 'vue-router'
    import { ref } from 'vue';
    import axiosClient from '../axios';
    import router from '../router';

    const data = ref({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    });

    const errors = ref({
        name: [],
        email: [],
        password: [],
        passwordConfirmation: []
    });

    function submit(){
        axiosClient.get('/sanctum/csrf-cookie')
            .then(resp => {
                axiosClient.post('/register', data.value)
                    .then(response => {
                        router.push({ name: 'Home'});
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error.response.data);
                        errors.value = error.response.data.errors;
                    });
            })
    }

</script>

<template>
    <GuestLayout>
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Crie sua Conta</h2>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <label for="nome" class="block text-sm/6 font-medium text-gray-900">Nome</label>
                <div class="mt-2">
                    <input type="text" name="nome" id="nome" autocomplete="name" required="" v-model="data.name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                <p v-if="errors.name" class="text-sm text-red-600">
                    {{ errors.name[0] }}
                </p>
            </div>

            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" autocomplete="email" required="" v-model="data.email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                <p v-if="errors.email" class="text-sm text-red-600">
                    {{ errors.email[0] }}
                </p>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Senha</label>
                </div>
                <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="current-password" required="" v-model="data.password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                <p v-if="errors.password" class="text-sm text-red-600">
                    {{ errors.password[0] }}
                </p>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="RepeatPassword" class="block text-sm/6 font-medium text-gray-900">Confirme a senha</label>
                </div>
                <div class="mt-2">
                    <input type="password" name="RepeatPassword" id="RepeatPassword" autocomplete="current-password" required="" v-model="data.password_confirmation" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Criar Conta</button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            Já é Membro?
            {{ ' ' }}
            <RouterLink :to="{name: 'Login' }" class="font-semibold text-indigo-600 hover:text-indigo-500">Acesse sua Conta</RouterLink>
        </p>
        </div>
    </GuestLayout>
</template>

<style scoped></style>