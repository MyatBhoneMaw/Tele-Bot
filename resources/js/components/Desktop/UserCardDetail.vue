<template>
    <!-- <layout> -->
        <div>
            hello useer : id = > {{ userId }}
     </div>
    <!-- </layout> -->
</template>

<script setup>
import { useRoute } from 'vue-router';
import layout from '@/Layouts/layout.vue'
const route = useRoute();
const userId = route.params.id;
</script>