<template>
  <layout>
    <div class="py-4 px-4">
      <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <UserCard 
          v-for="(user, index) in data" 
          :key="index" 
          :data="user" 
        />
      </div>
    </div>
  </layout>
</template>



<script setup>
import UserCard from './component/UserCard.vue'
    const data = ref([
        {
            name : 'Mg Mg',
            phone : '0978654321',
            plan : '25K Plan'
        },
        {
            name : 'Mg Mg',
            phone : '0978654321',
            plan : '25K Plan'
        },
        {
            name : 'Mg Mg',
            phone : '0978654321',
            plan : '25K Plan'
        },
        {
            name : 'Mg Mg',
            phone : '0978654321',
            plan : '25K Plan'
        },
        {
            name : 'Mg Mg',
            phone : '0978654321',
            plan : '25K Plan'
        },
        {
            name : 'Mg Mg',
            phone : '0978654321',
            plan : '25K Plan'
        },
        {
            name : 'Mg Mg',
            phone : '0978654321',
            plan : '25K Plan'
        },
        {
            name : 'Mg Mg',
            phone : '0978654321',
            plan : '25K Plan'
        },
    ])
    import layout from '@/Layouts/layout.vue';
    import {
        useRoute
    } from 'vue-router';
    import {
        ref,
        onMounted
    } from 'vue';

    const route = useRoute();
    const success = ref('');

    onMounted(() => {
        success.value = route.query.success || '';

        if (success.value) {
            setTimeout(() => {
                success.value = '';
            }, 3000);
        }
    });
</script>
