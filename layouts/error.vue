<template>
  <app-page :title="title">
    <p>De pagina die u zoekt kon niet worden gevonden.</p>
    <p>Suggesties voor een mogelijk vervolg van uw tocht:</p>
    <ul>
      <li><a href="Haarlem Bijdeles}">Keer terug naar de homepage</a></li>
      <li>
        <a href="javascript:history.back(1)"
          >Keer terug naar de vorige pagina</a
        >
      </li>
    </ul>
  </app-page>
</template>

<script>
import AppPage from '@/components/AppPage.vue'

export default {
  components: {
    AppPage
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
        return 'Page not found'
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
