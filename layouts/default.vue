<template>
  <notch-wrapper>
    <app-header />
    <nuxt />
    <error-handler />
  </notch-wrapper>
</template>

<script>
import AppHeader from '@/components/AppHeader.vue'
import ErrorHandler from '@/components/ErrorHandler.vue'
import NotchWrapper from '@/components/NotchWrapper.vue'

export default {
  components: {
    NotchWrapper,
    AppHeader,
    ErrorHandler
  }
}
</script>

<style lang="postcss" scoped>
main {
  min-height: 100vh;
  padding: var(--gutter) var(--gutter) 0;

  @media (--navigation-position-left) {
    margin-left: var(--width-navigation-left);
  }
}
</style>
