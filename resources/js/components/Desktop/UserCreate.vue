<template>
    <layout>
        <div class="">
            <div class="flex justify-center mt-4">
                <div class="bg-blue-200 py-2 text-center rounded-md px-30">
                    <h1 class="text-cyan-600 text-lg animate-fade-in-up select-none">
                        {{ success ? success : 'Create User' }}
                    </h1>
                </div>
            </div>
            <div class="mt-10"> 
                <form @submit.prevent="userCreate">
                <div class="flex justify-center">
                    <div class="">
                        <div class="flex justify-between">
                            <div class="px-10">
                                <div class="py-2">
                                    <label for="name"  class="text-cyan-200 animate-fade-in-up select-none">Name :</label>
                                </div>
                                <input type="text" v-model="form.name" placeholder="Name" id="name"
                                    class="border outline-0 py-2 px-3 border-cyan-500  focus:border-cyan-900 rounded">
                                <pre v-if="message.name" class="mt-2 text-sm text-red-500">{{ message . name[0] }}</pre>
                            </div>
                            <div class="px-2">
                                <div class="py-2">
                                    <label for="email" class="text-cyan-200 animate-fade-in-up select-none">Email :</label>
                                </div>
                                <input type="text" placeholder="Email" v-model="form.email" id="email" autocomplete="username"
                                    class="border outline-0 py-2 px-3 border-cyan-500 rounded  focus:border-cyan-900">
                                <pre v-if="message.email" class="mt-2 text-sm text-red-500">{{ message . email[0] }}</pre>
                            </div>
                        </div>

                        <div class="flex justify-between mt-4">
                            <div class="px-10">
                                <div class="py-2">
                                    <label for="phone" class="text-cyan-200 animate-fade-in-up select-none">Phone :</label>
                                </div>
                                <input type="text" placeholder="Phone Number" v-model="form.phone" id="phone"
                                    class="border outline-0 py-2 px-3  focus:border-cyan-900 border-cyan-500 rounded">
                                <pre v-if="message.phone" class="mt-2 text-sm text-red-500">{{ message . phone[0] }}</pre>
                            </div>
                            <div class="">
                                <div class="py-2">
                                    <label for="current-password" class="text-cyan-200 animate-fade-in-up">Password :</label>
                                </div>
                                <input type="password" placeholder="Password" v-model="form.password" id="current-password" autocomplete="current-password"
                                    class="border outline-0 py-2 px-3  focus:border-cyan-900 border-cyan-500 rounded">
                                <pre v-if="message.password" class="mt-2 text-sm text-red-500">{{ message . password[0] }}</pre>
                            </div>
                        </div>
                        <div class="py-5 flex float-end">
                            <button class="bg-cyan-200 py-2 px-6 rounded text-cyan-600 hover:bg-cyan-100"
                                type="submit">Create</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            
        </div>
    </layout>
</template>

<script setup>
    import layout from '@/Layouts/layout.vue';
    import {
        ref
    } from 'vue'
    import {
        post
    } from '@/utils/api'
    import {
        useRouter
    } from 'vue-router';
    const router = useRouter();
    const form = ref({
        name: '',
        email: '',
        phone: '',
        password: ''
    });
    const message = ref({
        name: '',
        email: '',
        phone: '',
        password: ''
    });
    const success = ref('');
    const userCreate = async () => {
        try {
            const data = await post('/create-user', form.value);
            if (data) {
                success.value = 'Successfully Created User';
            }
        } catch (error) {
            if (error.response) {
                message.value.name = error.response.data.errors?.name
                message.value.email = error.response.data.errors?.email
                message.value.phone = error.response.data.errors?.phone
                message.value.password = error.response.data.errors?.password
            } else if (error.request) {
                console.log('No response:', error.message);
            } else {
                console.log('Error:', error.message);
            }
        }
    }
</script>
