<template>
    <Layout>
        <div class="py-4 px-4">
            <!-- {{ tabs }} -->
            <div class="max-w-5xl mx-auto">
                <button v-for="tab in tabs" :key="tab.key" @click="tabChange(tab.key)"
                    :class="['px-4 py-2', active === tab.key ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black']">
                    {{ tab . name }}
                </button>


            </div>
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <UserCard v-for="(user, index) in users" :key="index" :data="user" />
            </div>
        </div>
    </Layout>
</template>



<script setup>
import Layout from '@/Layouts/layout.vue';
import { onMounted, ref, watch } from 'vue';
import UserCard from './component/UserCard.vue';
import { get } from '@/utils/api';

const users = ref([]);
const active = ref('');

const tabs = ref([
  { name: '15K Plan', key: '15K' },
  { name: '25K Plan', key: '25K' }
]);

const getBuyUser = async () => {
  try {
    const data = await get('/users', { plan: active.value }); // ✅ query param auto-handled
    if (data) {
      users.value = data.data;
    }
  } catch (error) {
    if (error.response) {
      console.log(error.response);
    }
  }
};

const tabChange = (key) => {
  active.value = key; // ✅ cleaner
};

// Automatically fetch data whenever active tab changes
watch(active, () => {
  if (active.value) getBuyUser();
});

// Set default active tab and trigger initial fetch
onMounted(() => {
  active.value = '15K';
});
</script>
