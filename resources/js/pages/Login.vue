<template>
  <div v-if="isMobile">
    <MobileLogin />
  </div>
  <div v-else-if="isTabletOrDesktop">
    heollo
    <DesktopLogin />
  </div>
</template>

<script setup>
import { useBreakpoints } from '@vueuse/core'
import DesktopLogin from '../components/Desktop/login.vue'
import MobileLogin from '../components/Mobile/login.vue'

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
