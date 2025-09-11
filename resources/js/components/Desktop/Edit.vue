<template>
  <layout>
    <div class="min-h-screen flex flex-col items-center py-10 px-4 select-none">
      
      <!-- Title -->
      <div class="w-full max-w-xl bg-cyan-950 text-center py-4 rounded shadow-md">
        <h1 class="text-2xl font-semibold text-cyan-400 animate-fade-in-up">
          <!-- {{ success ? success : 'Create User' }} --> Edit User
        </h1>
      </div>

      <!-- Form Section -->
      <form  class="w-full max-w-3xl mt-10 bg-gray-900 p-8 rounded-lg shadow-lg space-y-6">
        <div class="grid grid-cols-1 gap-6">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-cyan-300 mb-1">Name</label>
            <input
              type="text"
              v-model="form.name"
              value="user.name"
              placeholder="Full Name"
              id="name"
              class="w-full bg-gray-800 border border-cyan-500  px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500"
            />
            <!-- <p v-if="message.name" class="mt-1 text-sm text-red-500">{{ message.name[0] }}</p> -->
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-cyan-300 mb-1">Email</label>
            <input
              type="email"
              v-model="form.email"
              placeholder="example@domain.com"
              id="email"
              class="w-full bg-gray-800 border border-cyan-500  px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500"
              autocomplete="username"
            />
            <!-- <p v-if="message.email" class="mt-1 text-sm text-red-500">{{ message.email[0] }}</p> -->
          </div>

          <!-- Phone -->
          <div>
            <label for="phone" class="block text-sm font-medium text-cyan-300 mb-1">Phone</label>
            <input
              type="text"
              v-model="form.phone"
              placeholder="Phone Number"
              id="phone"
              class="w-full bg-gray-800 border border-cyan-500  px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500"
            />
            <!-- <p v-if="message.phone" class="mt-1 text-sm text-red-500">{{ message.phone[0] }}</p> -->
          </div>
        </div>
        <!-- Submit Button -->
        <div class="text-right">
          <button
            type="submit"
            class="bg-cyan-500 hover:bg-cyan-600  font-medium py-2 px-6 rounded transition duration-150"
          >
            Update
          </button>
        </div>
      </form>
    </div>
  </layout>
</template>

<script setup>
import { ref, watch } from 'vue';
import layout from '@/Layouts/layout.vue';
import { get } from '../../utils/api';
import { useRoute } from 'vue-router';

const route = useRoute();
const id = route.params.id;

const user = ref({});
const form = ref({
  name: '',
  email: '',
  phone: '',
});

const getUser = async () => {
  try {
    const data = await get(`/employee/${id}`);
    user.value = data?.data;
    
    form.value.name = user.value.name;
    form.value.email = user.value.email;
    form.value.phone = user.value.phone;

    console.log('User loaded:', user.value);
  } catch (error) {
    if (error.response) {
      console.log(error.response);
    }
  }
};

getUser();
</script>

