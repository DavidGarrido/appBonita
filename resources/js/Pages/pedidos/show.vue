<script setup>

import { Head, router } from '@inertiajs/vue3';
import { defineAsyncComponent, onMounted, ref } from 'vue'

const { pedido } = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    pedido: Object,
});

const AppLayout = defineAsyncComponent(() => import('@/Layouts/AppLayout.vue'))

onMounted(() => {
    console.log(pedido)
})

const volver = () => {
    router.visit(route('welcome'))
}


</script>
<template>
    <Head title="Pedido" />
    <app-layout>
        <p v-if="pedido == null">No existe el numero de pedido</p>
        <div class="flex flex-col items-center my-16" v-else>
            <!-- <p>{{ pedido }}</p> -->
            <p class="uppercase font-bold text-xl">Numero de pedido: {{ pedido.NumeroPedido }} </p>
            <p class="uppercase font-bold text-xl">Fecha de ingreso: {{ pedido.created_at.split('T')[0] }} </p>
            <div v-if="pedido.envios.length == 0">
                <p>No se ha realizado el envio de este pedido.</p>
            </div>
            <div v-else class="flex flex-col items-center">
                <p v-if="pedido.envios.length == 1" class="font-bold text-3xl">Tu pedido está en camino.</p>
                <div v-for="env in pedido.envios" :key="env" class="flex flex-col items-center">
                    <p class="uppercase font-bold text-xl">Tu número de guia es: {{ env.NumeroGuia }} </p>
                    <p class="uppercase font-bold text-xl">Consultalo en el canal oficial de {{ env.transportadora.nombre }}
                    </p>
                </div>
            </div>
        </div>
        <button @click="$event => volver()" class="bg-violet-900 text-white p-3 rounded-lg">Regresar</button>
    </app-layout>
</template>