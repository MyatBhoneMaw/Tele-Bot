<template>
    <div v-for="(d , i) in data" :key="i" class="py-3">
        <router-link :to="d.path" class="px-5 rounded py-2 bg-gray-400">
            {{ d . name }}
        </router-link>
    </div>
</template>
<script setup>
    import {
        ref
    } from 'vue';

    const data = ref([{
            name: 'Home',
            path: '/',
            slug: 'home'
        },
        {
            name: 'Create User',
            path: '/user-create',
            slug: 'user-create'
        }
    ]);
</script>
