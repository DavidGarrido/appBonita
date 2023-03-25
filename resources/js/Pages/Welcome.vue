<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, reactive, ref, defineAsyncComponent } from "vue";


const AppLayout = defineAsyncComponent(() => import("@/Layouts/AppLayout.vue"));

const code = ref()

const submit = () => {
    router.visit(route("pedidos.show", { pedido: code.value }));
};
</script>

<template>
    <Head title="Bienvenido" />
    <app-layout>
        <div class="w-full md:w-1/2 p-3 flex flex-col items-center">
            <h1 class="text-2xl lg:text-5xl font-extrabold text-center">SIGUE TU PEDIDO</h1>
            <div class="relative h-16 w-full">
                <form class="flex w-full" @submit.prevent="submit()">
                    <div class="absolute inset-0 flex flex-col pl-10 justify-center">
                        <input autofocus v-model.number="code" type="text" name="" id=""
                            class="rounded-lg pl-12 h-12 border-2" />
                    </div>
                    <div class="absolute inset-0 pointer-events-none">
                        <div
                            class="h-16 w-16 bg-gradient-to-r from-violet-500 to-fuchsia-500 rounded-full flex items-center justify-center">
                        </div>
                    </div>
                </form>
            </div>
            <p class="text-center">AGREGA AQUÍ TU NÚMERO DE PEDIDO PARA HACER SEGUIMIENTO</p>
        </div>
    </app-layout>
</template>


