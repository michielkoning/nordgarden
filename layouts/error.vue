<template>
  <app-page :title="title">
    {{ error.message }}
  </app-page>
</template>

<script>
import AppPage from '~/components/Layout/AppPage.vue'

export default {
  components: {
    AppPage,
  },
  props: {
    error: {
      type: Object,
      required: true,
    },
  },
  head() {
    return {
      title: this.title,
    }
  },

  computed: {
    title() {
      if (this.error.statusCode === 404) {
        return 'Page not found'
      }
      return 'An error occurred'
    },
  },
}
</script>
