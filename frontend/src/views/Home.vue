<script setup>
    import { PhotoIcon } from '@heroicons/vue/24/solid'
    import { ref } from 'vue'
    import axiosClient from '../axios';
    import router from '../router';

    const data = ref({
        label: '',
        file: null
    });

    function submit() {
        if (!data.value.file) {
            console.log("Nenhum arquivo selecionado.");
            return;
        }

        const formData = new FormData();
        formData.append('label', data.value.label);
        formData.append('image', data.value.file);
        
        axiosClient.post('/api/images', formData)
            .then(response => {
                console.log('Resposta da API:', response);
                router.push({ name: 'MyImages' });
            })
            .catch(error => {
                console.log('Erro ao salvar imagem:', error.response ? error.response.data : error);
            });
    }

    function handleFileUpload(event) {
        const file = event.target.files[0];
        if (file) {
            data.value.file = file;
        }
    }
</script>

<template>
    <header class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Início</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <form @submit.prevent="submit">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label for="label" class="block text-sm/6 font-medium text-gray-900">Nome</label>
                        <div class="mt-2">
                            <input type="text" name="label" id="label" v-model="data.label" autocomplete="given-label" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                </div>
            
                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Imagem</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <PhotoIcon class="mx-auto size-12 text-gray-300" aria-hidden="true" />
                            <div class="mt-4 flex text-sm/6 text-gray-600">
                                <label for="file" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="file" name="file" type="file" class="sr-only" @change="handleFileUpload" />
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
            
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="m-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
                </div>
            </form>
        </div>
    </main>
</template>

<style scoped></style>