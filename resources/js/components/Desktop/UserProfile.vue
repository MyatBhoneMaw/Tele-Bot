<template>
    <layout>
        <div class="bg-black text-cyan-400 min-h-screen flex items-center justify-center">
            <div class="bg-gray-900 p-6 rounded-lg shadow-lg w-full max-w-md text-center">
                <img class="w-24 h-24 rounded-full mx-auto border-4 border-cyan-400" :src="avatar"
                    alt="User Avatar" />
                <h2 class="text-2xl font-bold mt-4">{{ name }}</h2>
                <p class="text-cyan-300">{{ jobTitle }}</p>

                <div class="mt-4 text-sm text-cyan-200 space-y-1">
                    <p><strong>📞 Phone:</strong> {{ phone }}</p>
                    <p><strong>📧 Email:</strong> {{ email }}</p>
                </div>

                <button class="mt-6 bg-cyan-500 hover:bg-cyan-600 text-black font-semibold py-2 px-4 rounded">
                    Follow
                </button>
            </div>
        </div>
    </layout>

</template>

<script setup>
    import layout from '@/Layouts/layout.vue'
    const props = defineProps({
        name: String,
        phone: String,
        email: String,
        jobTitle: {
            type: String,
            default: 'Frontend Developer'
        },
        avatar: {
            type: String,
            default: 'https://i.pravatar.cc/150?img=3'
        }
    })
</script>
