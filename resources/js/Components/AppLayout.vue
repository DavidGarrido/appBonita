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
              <img :src="require('images/logo-bonita.png')" class="w-16" alt="" />
            </div>
          </div>
        </div>
      </div>
    </nav>
    <div class="flex-1 flex flex-col items-center justify-center w-1/2">
      <slot />
    </div>
  </div>
</template>
<script>
</script>