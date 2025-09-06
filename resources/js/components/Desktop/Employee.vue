<template>
  <layout>
    <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10 py-10 relative">

      <transition name="fade">
        <div v-if="success || validation" class="fixed top-4 right-4 z-50">
          <p class="bg-green-500 text-white px-4 py-2 rounded shadow-md" v-if="success">
            {{ success }}
          </p>
          <p class="bg-red-500 text-white px-4 py-2 rounded shadow-md" v-else-if="validation">
            {{ validation }}
          </p>
        </div>
      </transition>
      
      <table class="w-full table-fixed text-cyan-300 rounded bg-gray-900">
        <thead>
          <tr class="text-purple-500">
            <th class="w-1/5 py-4 px-6 text-left font-bold uppercase">No</th>
            <th class="w-1/5 py-4 px-6 text-left font-bold uppercase">Name</th>
            <th class="w-1/5 py-4 px-6 text-left font-bold uppercase">Email</th>
            <th class="w-1/5 py-4 px-6 text-left font-bold uppercase">Phone</th>
            <th class="w-1/5 py-4 px-6 text-left font-bold uppercase">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(data, i) in employees" :key="i">
            <td class="py-4 px-6 border-b border-gray-700">{{ i + 1 }}</td>
            <td class="py-4 px-6 border-b border-gray-700">{{ data.name }}</td>
            <td class="py-4 px-6 border-b border-gray-700 truncate">{{ data.email }}</td>
            <td class="py-4 px-6 border-b border-gray-700">{{ data.phone }}</td>
            <td class="py-4 px-6 border-b border-gray-700">
              <div class="flex space-x-2">
               
                <button class="text-blue-400 hover:text-blue-600">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                    <path fill="currentColor"
                      d="M224 128v80a16 16 0 0 1-16 16H48a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h80a8 8 0 0 1 0 16H48v160h160v-80a8 8 0 0 1 16 0m5.66-58.34l-96 96A8 8 0 0 1 128 168H96a8 8 0 0 1-8-8v-32a8 8 0 0 1 2.34-5.66l96-96a8 8 0 0 1 11.32 0l32 32a8 8 0 0 1 0 11.32m-17-5.66L192 43.31L179.31 56L200 76.69Z" />
                  </svg>
                </button>

              
                <button class="text-red-600 hover:text-red-800" @click="userDelete(data.id)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                    <g fill="currentColor">
                      <path d="M200 56v152a8 8 0 0 1-8 8H64a8 8 0 0 1-8-8V56Z" opacity="0.2" />
                      <path
                        d="M216 48h-40v-8a24 24 0 0 0-24-24h-48a24 24 0 0 0-24 24v8H40a8 8 0 0 0 0 16h8v144a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16V64h8a8 8 0 0 0 0-16M96 40a8 8 0 0 1 8-8h48a8 8 0 0 1 8 8v8H96Zm96 168H64V64h128Zm-80-104v64a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0m48 0v64a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0" />
                    </g>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </layout>
</template>

<script setup>
import { ref } from 'vue';
import layout from '@/Layouts/layout.vue';
import get from '../../utils/api';
import { post } from '../../utils/api';

const employees = ref([]);
const success = ref('');
const validation = ref('');

const fetchEmployee = async () => {
  try {
    const data = await get('/employee');
    if (data) {
      employees.value = data.data.data;
    }
  } catch (error) {
    console.error('Error fetching employees:', error);
  }
};

const userDelete = async (id) => {
  try {
    const data = await post('/delete', { id });
    if (data) {
      success.value = data.message;
      validation.value = ''; 
      fetchEmployee();

      setTimeout(() => {
        success.value = '';
      }, 2000);
    }
  } catch (error) {
    if (error.response) {
      validation.value = error.response.data.message || 'Something went wrong';
      success.value = ''; 
      setTimeout(() => {
        validation.value = '';
      }, 3000);
    }
  }
};

fetchEmployee();
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
