<template>
    <layout>
        <div class="flex items-center justify-center min-h-scree select-none">
            <div class="bg-gray-900 p-8 rounded-lg shadow-lg space-y-4 w-80 text-cyan-200">

                <div>
                    <span class="font-semibold text-cyan-400">User Name :</span>
                    <span class="text-cyan-200 px-3"> {{ data . user_name }} </span>
                </div>

                <div>
                    <span class="font-semibold text-cyan-400">Phone :</span>
                    <span class="text-cyan-200 px-3"> {{ data . phone }} </span>
                </div>

                <div>
                    <span class="font-semibold text-cyan-400">Plan :</span>
                    <span class="text-cyan-200 px-3"> {{ data . plan }} </span>
                </div>
                <div class="flex float-end pt-3">
                    <div class="px-3">
                        <router-link 
                            class="bg-red-600 px-3 py-1 rounded hover:bg-red-800 hover:text-white">Reject</router-link>
                    </div>
                    <div>
                        <router-link 
                            class="bg-green-600 px-3 py-1 rounded hover:bg-green-800 hover:text-white">Success</router-link>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script setup>
    defineProps({
        data: {
            type: Object,
            required: true
        }
    })
</script>
