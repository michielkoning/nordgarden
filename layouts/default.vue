<template>
  <div>
    <app-header />
    <nuxt />
    <error-handler />
  </div>
</template>

<script>
import AppHeader from '@/components/AppHeader.vue'
import ErrorHandler from '@/components/ErrorHandler.vue'
import { mapActions } from 'vuex'

export default {
  components: {
    AppHeader,
    ErrorHandler
  },

  mounted() {
    this.setTour()
  },
  methods: {
    ...mapActions({
      setTour: 'tour/set'
    })
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
