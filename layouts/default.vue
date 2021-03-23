<template>
  <notch-wrapper>
    <vue-announcer />
    <app-header />
    <nuxt />

    <error-handler />
  </notch-wrapper>
</template>

<script>
export default {
  head() {
    return this.$nuxtI18nHead({ addSeoAttributes: true })
  },
}
</script>

<script>
import AppHeader from '~/components/Layout/AppHeader.vue'
import ErrorHandler from '~/components/Layout/ErrorHandler.vue'
import NotchWrapper from '~/components/Layout/NotchWrapper.vue'

export default {
  components: {
    NotchWrapper,
    AppHeader,
    ErrorHandler,
  },
}
</script>
