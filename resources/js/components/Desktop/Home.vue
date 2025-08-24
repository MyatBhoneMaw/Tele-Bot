<template>
    <div class="p-4">
        <router-link to="/user-create" class="py-2 px-2 bg-blue-500 rounded">Create User</router-link>
    </div>
</template>

<script setup>
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
