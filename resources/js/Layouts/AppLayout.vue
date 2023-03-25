<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>
<template>
    <div v-if="$page.props.flash.success"
        class="fixed z-50 flex items-center justify-between w-1/2 max-w-3xl p-3 my-8 mx-1 bg-green-500 rounded-lg notify">
        <div class="text-white">{{ $page.props.flash.success }}</div>
        <button type="button" class="p-2 mr-2 group">
            <svg class="block w-2 h-2 fill-green-800 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg"
                width="235.908" height="235.908" viewBox="278.046 126.846 235.908 235.908">
                <path
                    d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z" />
            </svg>
        </button>
    </div>
    <div class="h-screen bg-center relative">
        <div class="absolute inset-0 flex items-center justify-center opacity-20">
            <img :src="'../images/fondo-bonita.png'">
        </div>
        <div class="absolute inset-0 z-50 flex flex-col items-center ">
            <nav class="bg-black dark:bg-gray-800  border-yellow-600 border-b-8 dark:border-gray-700 rounded-b-xl w-full">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center w-full justify-between text-white">
                            <div class="shrink-0 flex items-center">
                                <img :src="'../images/logo-bonita.png'" class="w-16" alt="" />
                            </div>
                            <h1 class="font-bold text-3xl hidden md:block">
                                ¡GRACIAS POR TU COMPRA!
                            </h1>
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <div v-if="$page.props.auth.user">
                                    <div class="ml-3 relative">
                                        <Dropdown align="right" width="48">
                                            <template #trigger>
                                                <button v-if="$page.props.jetstream.managesProfilePhotos"
                                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover"
                                                        :src="$page.props.auth.user.profile_photo_url"
                                                        :alt="$page.props.auth.user.name" />
                                                </button>

                                                <span v-else class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                        {{
                                                            $page.props.auth.user
                                                                .name
                                                        }}

                                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Enlaces
                                                </div>
                                                <DropdownLink :href="route('welcome')">
                                                    Inicio
                                                </DropdownLink>
                                                <DropdownLink :href="route('dashboard')">
                                                    Dashboard
                                                </DropdownLink>
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Control de Cuenta
                                                </div>

                                                <DropdownLink :href="route('profile.show')">
                                                    Perfil
                                                </DropdownLink>

                                                <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                                    :href="route('api-tokens.index')">
                                                    API Tokens
                                                </DropdownLink>

                                                <div class="border-t border-gray-200 dark:border-gray-600" />

                                                <!-- Authentication -->
                                                <form @submit.prevent="logout">
                                                    <DropdownLink as="button">
                                                        Salir
                                                    </DropdownLink>
                                                </form>
                                            </template>
                                        </Dropdown>
                                    </div>
                                </div>
                                <template v-else>
                                    <Link :href="route('login')"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    Log in</Link>
                                    <Link :href="route('register')"
                                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    Register</Link>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="flex-1 flex flex-col items-center justify-center w-full">
                <slot />
            </div>
        </div>
    </div>
</template>
<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
