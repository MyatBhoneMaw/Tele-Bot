<template>
    <layout>
        <div class="flex items-center justify-center min-h-scree select-none">
            <div class="bg-gray-900 p-8 rounded-lg shadow-lg space-y-4 w-80 text-cyan-200">

                <div>
                    <span class="font-semibold text-cyan-400">Name :</span>
                    <span class="text-cyan-200 px-3"> {{ data . name }} </span>
                </div>

                <div>
                    <span class="font-semibold text-cyan-400">Phone :</span>
                    <span class="text-cyan-200 px-3"> {{ data . phone }} </span>
                </div>

                <div>
                    <span class="font-semibold text-cyan-400">Plan :</span>
                    <span class="text-cyan-200 px-3"> {{ data . plan }} </span>
                </div>
                <div class="flex float-end">
                  <router-link class="bg-purple-600 px-3 py-2 rounded hover:bg-purple-800 hover:text-white">Detail</router-link>
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
