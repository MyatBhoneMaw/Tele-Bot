<template>
    <Layout>
        <div class="flex max-w-5xl mx-auto space-x-4 border-gray-700 px-4 py-5 cursor-pointer">
            <button v-for="tab in tabs" :key="tab.key" @click="tabChange(tab.key)"
                class="relative px-4 py-2 font-medium transition duration-300 ease-in-out cursor-pointer"
                :class="active === tab.key ? 'text-cyan-400' : 'text-white hover:text-cyan-300'">
                {{ tab . name }}
                <span class="absolute left-0 -bottom-1 h-0.5 bg-cyan-400 transition-all duration-300 ease-in-out"
                    :class="active === tab.key ? 'w-full' : 'w-0'"></span>
            </button>
        </div>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <UserCard v-for="(user, index) in users" :key="index" :data="user" />
        </div>
    </Layout>
</template>

<script setup>
    import Layout from '@/Layouts/layout.vue';
    import {
        onMounted,
        ref,
        watch
    } from 'vue';
    import UserCard from './component/UserCard.vue';
    import {
        get
    } from '@/utils/api';

    const users = ref([]);
    const active = ref('');

    const tabs = ref([{
            name: '15K Plan',
            key: '15K'
        },
        {
            name: '25K Plan',
            key: '25K'
        }
    ]);

    const getBuyUser = async () => {
        try {
            const data = await get('/users', {
                plan: active.value
            });
            if (data) {
                users.value = data.data;
            }
        } catch (error) {
            if (error.response) {
                console.log('error');
            }
        }
    };

    const tabChange = (key) => {
        active.value = key;
    };

    watch(active, () => {
        if (active.value) getBuyUser();
    });

    onMounted(() => {
        active.value = '15K';
    });
</script>
