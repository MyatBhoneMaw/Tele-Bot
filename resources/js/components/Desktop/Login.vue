<template>
  <div class="flex items-center justify-center min-h-screen select-none">
    <div class="bg-gray-900 shadow-lg rounded-lg w-[400px] p-6">
      <form class="space-y-6" @submit.prevent="login">
        <div class="text-center">
          <h1 class="text-2xl font-bold text-cyan-400">Login</h1>
          <p class="text-sm text-gray-400">Enter your credentials to continue</p>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-300">Email :</label>
          <input
            type="text"
            id="email"
            placeholder="Email"
            v-model="form.email"
            class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 placeholder-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500"
          />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-300">Password :</label>
          <input
            type="password"
            id="password"
            placeholder="Password"
            v-model="form.password"
            class="mt-1 block w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 placeholder-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500"
          />
        </div>

        <div>
          <button
            type="submit"
            class="w-full bg-cyan-600 py-2 px-4 rounded-md hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-400"
          >
            Log In
          </button>
        </div>

        <!-- Debug output (optional) -->
        <!-- <pre class="text-sm text-gray-400">{{ form }}</pre> -->
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { post } from '../../utils/api';
import { useRouter } from 'vue-router';

const router = useRouter();

const form = ref({
  email: '',
  password: '',
});

const login = async () => {
  try {
    // await postJson('/sanctum/csrf-cookie');
    const response = await post('/login', form.value);
  console.log('Login response:', response); // 🔍 Check what exactly came back

    // Safely check if user exists in response
    const user = response.user || response.data?.user;

    if (user) {
      localStorage.setItem('user', JSON.stringify(user));
      router.push('/user-profile');
    } else {
      alert('Login successful, but user data not returned.');
    }
  } catch (error) {
    console.error('Login failed:', error);

    if (error.response) {
      console.error('Status:', error.response.status);
      console.error('Data:', error.response.data);

      alert(error.response.data.message || 'Invalid credentials.');
    } else {
      console.error('Error:', error.message);
      alert('Something went wrong. Please try again.');
    }
  }
};

</script>
