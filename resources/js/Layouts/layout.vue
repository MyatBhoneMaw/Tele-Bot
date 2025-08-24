<template>
    <div class="grid grid-cols-12">
        <div class="col-span-2 border-r border-r-cyan-300">
            <Aside></Aside>
        </div>
        <div class="col-span-10 min-h-screen">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
    import Aside from './aside.vue'
</script>
