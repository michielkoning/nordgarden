<template>
  <div id="app" tabindex="-1">
    <notch-wrapper>
      <app-header />
      <p>Error</p>
      <error-handler />
    </notch-wrapper>
  </div>
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
  },
  props: {
    error: {
      type: Object,
      required: true
    }
  },
  computed: {
    title() {
      if (this.error.statusCode === 404) {
        return 'Pagina niet gevonden'
      }
      return 'An error occurred'
    }
  },
  head() {
    return {
      title: this.title
    }
  }
}
</script>
