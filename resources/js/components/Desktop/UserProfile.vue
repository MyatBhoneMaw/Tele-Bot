<template>
    <layout>
        <div class="mt-10">
            <div class="mx-10 text-cyan-400 overflow-hidden shadow-xl rounded-xl border border-cyan-700">
                <div class="px-6 py-6 bg-gray-900 border-b border-cyan-700 rounded-t-xl">
                    <h3 class="text-xl font-semibold text-cyan-300">
                        Profile
                    </h3>
                    <!-- <p class="mt-1 text-sm text-cyan-500">
                        This is some information about the user.
                    </p> -->
                </div>
                <div class="px-6 py-5">
                    <dl class="divide-y divide-cyan-800">
                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-cyan-500">
                                Full name
                            </dt>
                            <dd class="text-sm text-cyan-200 col-span-2">
                                {{ user . name }}
                            </dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-cyan-500">
                                Email address
                            </dt>
                            <dd class="text-sm text-cyan-200 col-span-2">
                                {{ user . email }}
                            </dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-cyan-500">
                                Phone number
                            </dt>
                            <dd class="text-sm text-cyan-200 col-span-2">
                                {{ user . phone }}
                            </dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-cyan-500">
                                Address
                            </dt>
                            <dd class="text-sm text-cyan-200 col-span-2">
                                some-address
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="my-4 flex justify-center">
                <button class="bg-gray-900 text-cyan-500 rounded px-4 py-2 hover:bg-gray-700"
                    @click="logout">Logout</button>
            </div>
        </div>
    </layout>

</template>

<script setup>
    import layout from '@/Layouts/layout.vue'
    import {
        useRouter
    } from 'vue-router';
    import {
        postJson,
        post
    } from '../../utils/api'
    const router = useRouter();
    const user = JSON.parse(localStorage.getItem('user'));
    const id = user.id
    const logout = async () => {
        const data = await post('/logout', {
            id: id
        });
        if (data?.message == 'success') {
            localStorage.removeItem('user');
            router.push('/login');
        } else {
            console.log(error)
        }
    }
</script>
