<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-black">
    <h1
      class="text-9xl font-bold text-cyan-500 animate-blink"
    >
      404
    </h1>
    <p class="text-cyan-300 text-xl mt-4">Not Found</p>
    <div class="mt-6">
      <router-link
        to="/home"
        class="text-cyan-400 hover:text-cyan-600 underline"
      >
        Go Back Home
      </router-link>
    </div>
  </div>
</template>

<style>
@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.3; }
}
.animate-blink {
  animation: blink 1.5s infinite;
}
</style>
