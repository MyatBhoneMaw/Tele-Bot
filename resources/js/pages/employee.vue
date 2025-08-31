<template>
    <div v-if="isTabletOrDesktop">
        <Employee />
    </div>
</template>

<script setup>
import { useBreakpoints } from '@vueuse/core'
import Employee from '@/components/Desktop/Employee.vue'

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