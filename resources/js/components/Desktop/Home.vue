<template>
    <div class="flex justify-center py-5 w-full">
        <div class="bg-white">
            <div v-if="success" class="text-green-500">
                {{ success }}
            </div>
            <div class="pt-2">
                <h1 class="text-center">25K Plan</h1>
            </div>
            <div class="py-3 px-4">
                <div>
                    name : Myat Bhone Maw
                </div>
            </div>

        </div>
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
