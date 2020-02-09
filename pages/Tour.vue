<template>
  <app-page :title="title">
    <tour-dates />
  </app-page>
</template>

<script>
import TourDates from '@/components/TourDates.vue'
import AppPage from '@/components/AppPage.vue'

export default {
  components: {
    TourDates,
    AppPage
  },
  data() {
    return {
      title: this.$t('tour')
    }
  },
  head() {
    return {
      title: this.title
    }
  }
}
</script>
