<template>
    <div v-if="isTabletOrDesktop">
        <UserCardDetail />
    </div>
</template>

<script setup>
import { useBreakpoints } from '@vueuse/core'
import UserCardDetail from '@/components/Desktop/UserCardDetail.vue'
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