<script setup>
    import { ref, onMounted } from 'vue'
    import axiosClient from '../axios'

    const images = ref([])

    onMounted(() => {
        axiosClient.get('/api/images')
            .then(response => {
                images.value = response.data;
            })
            .catch(error => {
                console.log('Erro ao buscar imagens:', error.response ? error.response.data : error);
            });
    })

    const copyImageUrl = (url) => {
        navigator.clipboard.writeText(url)
            .then(() => alert('URL copiada!'))
            .catch(() => alert('Erro ao copiar URL.'));
    };

    const deleteImage = (id) => {
        if(!confirm('Tem certeza que deseja deletar esta imagem?')) {
            return;
        }
        
        axiosClient.delete('/api/images/' + id)
            .then(() => {
                images.value = images.value.filter(image => image.id !== id);
            })
            .catch(error => {
                console.log('Erro ao deletar imagem:', error.response ? error.response.data : error);
            });
    }
</script>

<template>
    <header class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Minhas Imagens</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <div v-for="image in images" :key="image.id" class="bg-white overflow-hidden shadow rounded-lg">
                    <img :src="image.url" alt="Image" class="w-full h-48 object-contain">
                    <div class="px-4 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ image.label }}</h3>
                        <div class="flex justify-between ">
                            <button type="submit"
                                    @click="copyImageUrl(image.url)"
                                    class="rounded-md bg-indigo-600 px-3 py-1 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Copy Image Url
                            </button>
                            <button type="submit"
                                    @click="deleteImage(image.id)"
                                    class="rounded-md bg-red-600 px-3 py-1 text-sm/6 font-semibold text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<style scoped></style>