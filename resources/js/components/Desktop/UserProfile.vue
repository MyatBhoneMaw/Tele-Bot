<template>
    <layout>
        <div class="mt-10">
            <div class="mx-10 text-cyan-400 overflow-hidden shadow-xl rounded-xl border border-cyan-700">
                <div class="px-6 py-6 bg-gray-900 border-b border-cyan-700 rounded-t-xl">
                    <h3 class="text-xl font-semibold text-cyan-300">
                        Bue Profile
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
                                John Doe
                            </dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-cyan-500">
                                Email address
                            </dt>
                            <dd class="text-sm text-cyan-200 col-span-2">
                                johndoe@example.com
                            </dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-cyan-500">
                                Phone number
                            </dt>
                            <dd class="text-sm text-cyan-200 col-span-2">
                                (123) 456-7890
                            </dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-cyan-500">
                                Address
                            </dt>
                            <dd class="text-sm text-cyan-200 col-span-2">
                                123 Main St<br>
                                Anytown, USA 12345
                            </dd>
                        </div>
                    </dl>
                </div>
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
