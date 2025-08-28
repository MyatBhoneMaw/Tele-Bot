<template>
    <div v-if="isTabletOrDesktop">
        <Plan />
    </div>
</template>

<script setup>
import { useBreakpoints } from '@vueuse/core'
import Plan from '@/components/Desktop/Plan.vue'

const breakpoints = useBreakpoints({
  sm: 640,
  md: 768,
  lg: 1024,
})

// Mobile < 768px
const isMobile = breakpoints.smaller('md')

// Tablet or Desktop ≥ 768px
const isTabletOrDesktop = breakpoints.greaterOrEqual('md')
</script>