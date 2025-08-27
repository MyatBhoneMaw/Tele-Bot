<template>
    <layout>
          <div class="bg-black text-cyan-400 min-h-screen flex items-center justify-center">
    <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-full max-w-md text-center">
      <img
        class="w-24 h-24 rounded-full mx-auto border-4 border-cyan-400"
        src="https://i.pravatar.cc/150?img=3"
        alt="User Avatar"
      />
      <h2 class="text-2xl font-bold mt-4">John Doe</h2>
      <p class="text-cyan-300">Frontend Developer</p>
      <p class="mt-2 text-sm text-cyan-200">
        Passionate about building beautiful and functional user interfaces.
      </p>
      <button
        class="mt-4 bg-cyan-500 hover:bg-cyan-600 text-black font-semibold py-2 px-4 rounded"
      >
        Follow
      </button>
    </div>
  </div>
    </layout>

</template>

<script setup>
import layout from '../../Layouts/layout.vue'
</script>
