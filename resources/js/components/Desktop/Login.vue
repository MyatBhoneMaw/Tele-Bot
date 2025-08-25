<template>
  <div class="flex items-center justify-center min-h-screen bg-black">
    <div class="bg-gray-900 shadow-lg rounded-lg w-[400px] p-6">
      <form class="space-y-6">
        <div class="text-center">
          <h1 class="text-2xl font-bold text-cyan-400">Login</h1>
          <p class="text-sm text-gray-400">Enter your credentials to continue</p>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-300">Email :</label>
          <input
            type="text"
            id="email"
            placeholder="email"
            class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-md px-3 py-2 placeholder-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500"
          />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-300">Password :</label>
          <input
            type="password"
            id="password"
            placeholder="Password"
            class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-md px-3 py-2 placeholder-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500"
          />
        </div>

        <div>
          <button
            type="submit"
            class="w-full bg-cyan-600 text-white py-2 px-4 rounded-md hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-400"
          >
            Log In
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
