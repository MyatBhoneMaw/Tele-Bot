<template>
    <layout>
        <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10 py-10">
            <!-- {{ employees }} -->
            <table class="w-full table-fixed text-cyan-300 rounded bg-gray-900">
                <thead>
                    <tr class="text-purple-500">
                        <th class="w-1/4 py-4 px-6 text-left font-bold uppercase">No</th>
                        <th class="w-1/4 py-4 px-6 text-left font-bold uppercase">Name</th>
                        <th class="w-1/4 py-4 px-6 text-left font-bold uppercase">Email</th>
                        <th class="w-1/4 py-4 px-6 text-left font-bold uppercase">Phone</th>
                        <th class="w-1/4 py-4 px-6 text-left font-bold uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr v-for="(data, i) in employees" :key="i">
                        <td class="py-4 px-6 border-b border-gray-200">{{ i+1 }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ data.name }}</td>
                        <td class="py-4 px-6 border-b border-gray-200 truncate">{{ data.email }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ data.phone }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">
                            <span class="bg-green-500 text-black py-1 px-2 rounded-full text-xs">active</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </layout>
</template>

<script setup>
    import {
        ref
    } from 'vue';;
    import layout from '@/Layouts/layout.vue';
    import get from '../../utils/api'
    const employees = ref([]);
    const no = ref(0);
    const fetchEmployee = async () => {
        try {
            const data = await get('/employee');
            if (data) {
                employees.value = data.data.data
            }
            console.log('res-employee', data.data.data);
        } catch (error) {
            console.log(error);
        }

    }

    fetchEmployee();
</script>
