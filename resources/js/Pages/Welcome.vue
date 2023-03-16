<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, reactive } from "vue";

const {envio, phpVersion} = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
  envio: Object
});

  onMounted( () => {
      console.log(envio === null)
  })

const form = reactive({
  code: "",
});

function submit() {
  //   form.post("/search", {
  //     onSuccess: () => form.reset("code"),
  //   });
  router.post("/search", form, {
    onSuccess: (res) => {
      console.log(res);
    },
  });
}
</script>

<template>
  <Head title="Bienvenido" />
  <div
    v-if="$page.props.flash.success"
    class="fixed z-50 flex items-center justify-between w-1/2 max-w-3xl p-3 my-8 mx-1 bg-green-500 rounded-lg notify"
  >
    <div class="text-white">{{ $page.props.flash.success }}</div>
    <button type="button" class="p-2 mr-2 group">
      <svg
        class="block w-2 h-2 fill-green-800 group-hover:fill-white"
        xmlns="http://www.w3.org/2000/svg"
        width="235.908"
        height="235.908"
        viewBox="278.046 126.846 235.908 235.908"
      >
        <path
          d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z"
        />
      </svg>
    </button>
  </div>
  <div
    class="bg-bonita bg-opacity-50 h-screen bg-center bg-50% bg-no-repeat flex flex-col items-center"
  >
    <nav
      class="bg-black dark:bg-gray-800 border-b border-yellow-600 border-b-8 dark:border-gray-700 rounded-b-xl w-full"
    >
      <!-- Primary Navigation Menu -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center w-full justify-between text-white">
            <!-- Settings Dropdown -->
            <div class="ml-3 relative"></div>
            <h1 class="font-bold text-3xl">¡GRACIAS POR TU COMPRA!</h1>
            <div class="shrink-0 flex items-center">
              <img src="images/logo-bonita.png" class="w-16" alt="" />
            </div>
          </div>
        </div>
      </div>
    </nav>
    <div class="flex-1 flex flex-col items-center justify-center w-1/2">
      <h1 class="text-5xl font-extrabold">SIGUE TU PEDITO</h1>
      <div class="relative h-16 w-full">
        <form class="flex w-full" @submit.prevent="submit()">
          <div class="absolute inset-0 flex flex-col pl-10 justify-center">
            <input
              v-model="form.code"
              type="text"
              name=""
              id=""
              class="rounded-lg pl-12 h-12 border-2"
            />
          </div>
          <div class="absolute inset-0 pointer-events-none">
            <div
              class="h-16 w-16 bg-gradient-to-r from-violet-500 to-fuchsia-500 rounded-full flex items-center justify-center"
            ></div>
          </div>
        </form>
      </div>
      <p>AGREGA AQUÍ TU NÚMERO DE PEDIDO PARA HACER SEGUIMIENTO</p>
    </div>
  </div>
</template>

<style>
.bg-bonita::before {
  content: "";
  background-image: url("images/fondo-bonita.png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  z-index: -1;
  position: absolute;
  top: 0px;
  right: 0px;
  bottom: 0px;
  left: 0px;
  opacity: 0.25;
  background-size: 30%;
}

.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>
