<template>
  <layout>
    <div class="py-4 px-4">
        <!-- {{ users }} -->
      <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <UserCard 
          v-for="(user, index) in users" 
          :key="index" 
          :data="user" 
        />
      </div>
    </div>
  </layout>
</template>



<script setup>
import { ref } from 'vue';
import UserCard from './component/UserCard.vue';
import { get } from '@/utils/api';
import layout from '@/Layouts/layout.vue';

const users = ref([]);
const getBuyUser = async () => {
    try {
    const data = await get('/users');
    if(data) {
        users.value = data.data;
    }
    }
     catch (error) {
        if(error.response){
            console.log(error.response);
        }
    }
}

getBuyUser();
</script>
