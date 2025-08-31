<template>
    <router-link v-for="(d, i) in data" :key="i" :to="d.path"
        class="block text-center py-3 w-full"
        :class="{
            'bg-purple-600 rounded border-b border-cyan-300': active === d.slug,
            'text-cyan-300': active !== d.slug
        }">
        {{ d . name }}
    </router-link>
</template>

<script setup>
    import {
        ref,
        watchEffect
    } from 'vue'
    import {
        useRoute
    } from 'vue-router'

    const data = ref([{
            name: 'Home Page',
            path: '/',
            slug: 'home'
        },
        {
            name: 'Plan',
            path: '/plan',
            slug: 'plan'

        },
        {
            name: 'Create User',
            path: '/user-create',
            slug: 'user-create'
        },
        {
            name : 'Employee',
            path : '/employee',
            slug : 'employee'
        },
        {
            name: 'Profile',
            path: '/user-profile',
            slug: 'user-profile'
        },
    ])

    const active = ref('')

    const route = useRoute()

    watchEffect(() => {
        const matched = data.value.find((item) => item.path == route.path)
        if (matched) {
            active.value = matched.slug
        } else {
            active.value = ''
        }
    })
</script>
