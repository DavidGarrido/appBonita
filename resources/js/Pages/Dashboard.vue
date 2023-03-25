<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import { router, Head, useForm } from '@inertiajs/vue3';



const form = reactive({
    NumeroPedido: null,
    NumeroGuia: null,
    transportadora: 1
})
const formDoc = useForm({
    doc: null
})

const data = reactive({
    transportadoras: [],
    documento: null,
    envios: [],
    viewPlantilla: false,
})


onMounted(() => {
    gettransportadoras()
})

function uploadDoc(e) {
    let file = e.target.files[0]
    data.documento = file
    enviarDocumento()
}
function enviarDocumento() {
    var datos = new FormData();
    datos.append('documento', data.documento)
    datos.append('_method', 'POST')
    axios.post('/cargaPlantilla', datos).then(
        res => {
            console.log(res.data);
            data.envios = res.data
            if (data.envios.length > 0) {
                data.viewPlantilla = true
            }
        }
    )
}
function onFileChange(event) {
    // actualiza el objeto form con el archivo seleccionado
    let doc = new FileReader()
    var documento = event.target.files[0]
    doc.onload = (e) => {
        formDoc.doc = e.target.result
    }
    doc.readAsDataURL(documento)
}

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
// function submitDoc() {
//     var datos = new FormData();
//     datos.append('doc', )
//     axios.post('/cargaPlantilla', formDoc)
//         .then(res => {
//             console.log(res)
//         })
// }
function gettransportadoras() {
    axios.get('/transportadora')
        .then(res => {
            data.transportadoras = ref(res.data)
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
        <div class="flex-1 w-full md:w-3/4 py-3 flex flex-col gap-2">
            <div class="overflow-hidden shadow-xl flex flex-col lg:flex-row p-2 rounded-lg bg-white gap-3">
                <!-- <Welcome /> -->
                <form @submit.prevent="submit()" class="flex flex-col lg:flex-row gap-2 flex-1">
                    <input type="number" v-model="form.NumeroPedido" placeholder="Numero de Pedido"
                        class="flex-1 rounded-lg">
                    <input type="number" v-model="form.NumeroGuia" placeholder="Numero de Guia" class="flex-1 rounded-lg">
                    <select v-if="data.transportadoras.length > 0" v-model="form.transportadora" class="rounded-lg">
                        <option v-for="trans in data.transportadoras" :key="trans" :value="trans.id">{{ trans.nombre }}
                        </option>
                    </select>
                    <button type="submit" class="bg-violet-900 text-white p-3 rounded-lg">Agregar</button>
                </form>
                <form @submit.prevent="$event => enviarDocumento()" class="flex flex-col">
                    <!-- <input type="file" @input="$event => formDoc.doc = $event.target.files[0]"> -->
                    <input type="file" @change="uploadDoc" class="hidden" id="chargeDoc">
                    <label class="bg-green-700 text-white font-bold flex items-center justify-center p-2 rounded-lg flex-1"
                        for="chargeDoc"><p class="text-center">Cargar Plantilla</p></label>
                    <progress v-if="formDoc.progress" :value="formDoc.progress.percentage" max="100">
                        {{ formDoc.progress.percentage }}%
                    </progress>
                    <!-- <button type="submit">Cargar</button> -->
                </form>
            </div>
            <div v-if="data.viewPlantilla" class="bg-white p-3 flex flex-col gap-3 rounded-lg shadow-xl border-2 border-gray-300 mx-2">
                <div class="flex justify-center">
                    <p class="text-center font-bold text-xl">Se há almacenado la plantilla</p>
                </div>
                <div class="hidden md:flex gap-2 p-2 font-bold ">
                    <div class="w-12">#</div>
                    <div class="flex-1">Número Guía</div>
                    <div class="flex-1">Número Pedido</div>
                    <div class="flex-1">Transportadora</div>
                </div>
                <div v-if="data.envios.length > 0" class="divide-y divide-gray-300">
                    <div v-for="env in data.envios" :key="env.id" class="flex flex-col md:flex-row gap-2 p-2">
                        <div class="w-full md:w-12 flex items-center md:justify-center gap-3">
                            <p class="md:hidden font-bold">Número Envio:</p>
                            <p class="flex-1">{{ env.id }}</p>
                        </div>
                        <div class="w-full md:flex-1 flex items-center md:justify-center gap-3">
                            <p class="md:hidden font-bold">Número Guia:</p>
                            <p class="flex-1">{{ env.NumeroGuia }}</p>
                        </div>
                        <div class="w-full md:flex-1 flex items-center md:justify-center gap-3">
                            <p class="md:hidden font-bold">Número Pedido:</p>
                            <p class="flex-1">{{ env.pedido.NumeroPedido }}</p>
                        </div>
                        <div class="w-full md:flex-1 flex items-center md:justify-center gap-3">
                            <p class="md:hidden font-bold">Transportadora:</p>
                            <p class="flex-1">{{ env.transportadora.nombre }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button @click="data.viewPlantilla = false" class="bg-violet-900 text-white p-3 rounded-lg font-bold">Perfecto</button>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
