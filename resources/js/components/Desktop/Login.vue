<template>
    <div class="flex items-center justify-center min-h-screen select-none">
        <div class="bg-gray-900 shadow-lg rounded-lg w-[400px] p-6">
            <form class="space-y-6" @submit.prevent="login()">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-cyan-400">Login</h1>
                    <p class="text-sm text-gray-400">Enter your credentials to continue</p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email :</label>
                    <input type="text" id="email" placeholder="email" v-model="form.email"
                        class="mt-1 block w-full bg-gray-800  border border-gray-700 rounded-md px-3 py-2 placeholder-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500" />
                    <p v-if="message.email" class="mt-2 text-sm text-red-500">{{ message . email[0] }}</p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Password :</label>
                    <input type="password" id="password" placeholder="Password" v-model="form.password"
                        class="mt-1 block w-full bg-gray-800  border border-gray-700 rounded-md px-3 py-2 placeholder-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500" />
                    <p v-if="message.password" class="mt-2 text-sm text-red-500">{{ message . password[0] }}</p>
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-cyan-600  py-2 px-4 rounded-md hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
    import {
        ref
    } from 'vue';
    import {
        post
    } from '../../utils/api'
    import {
        useRouter
    } from 'vue-router';
    const router = useRouter();
    const message = ref({
        email: '',
        password: ''
    })
    const form = ref({
        email: '',
        password: ''
    });
    const login = async () => {
        try {
           
            const data = await post('/login', form.value);

            console.log('initial-data', data);
            localStorage.setItem('user', JSON.stringify(data));
            console.log('my-user',JSON.parse(localStorage.getItem('user')));
        
            router.push('/');

        } catch (error) {
            if (error.response) {
                message.value.email = error.response.data.errors?.email || '';
                message.value.password = error.response.data.errors?.password || '';

                console.log('Validation error:', message.value.email);
                console.error('Login failed:', error.response?.data);
            } else {
                console.error('Network error or unknown:', error);
            }
        }
    };
</script>
