<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import { router, Head } from '@inertiajs/vue3';



const form = reactive({
    NumeroPedido: null,
    NumeroGuia: null,
    transportadora: 1
})

const data = reactive({
    transportadoras: []
})


onMounted(() => {
    gettransportadoras()
})

function submit() {
    axios.post('/envio', form)
        .then(res => {
            console.log(res.data)
            if (res.data.id != null) {
                Object.assign(form, {
                    NumeroPedido: null,
                    NumeroGuia: null,
                    transportadora: 1
                })
            }
        })
}
function gettransportadoras() {
    axios.get('/transportadora')
        .then(res => {
            data.transportadoras = ref(res.data)
            console.log(data.transportadoras)
        })
}
</script>

<template>
    <AppLayout>

        <Head title="Agrega tu Envio" />
        <!-- <template #header>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Dashboard
                </h2>
            </template> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl ">
                    <!-- <Welcome /> -->
                    <form @submit.prevent="submit()" class="flex flex-col gap-2">
                        <input type="number" v-model="form.NumeroPedido" placeholder="Numero de Pedido">
                        <input type="number" v-model="form.NumeroGuia" placeholder="Numero de Guia">
                        <select v-if="data.transportadoras.length > 0" v-model="form.transportadora">
                            <option v-for="trans in data.transportadoras" :key="trans" :value="trans.id">{{ trans.nombre }}</option>
                        </select>
                        <button type="submit" class="bg-violet-900 text-white p-3 rounded-lg">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
