<template>
  <app-page :title="title">
    <tour-dates />
  </app-page>
</template>

<script>
import TourDates from '~/components/Tour/TourDates.vue'
import AppPage from '~/components/AppPage.vue'
import getSeoMetaData from '~/helpers/seo'

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
    const { title } = this
    const slug = 'tour'
    const metaDesc = 'Tour dates'
    return getSeoMetaData(title, metaDesc, slug)
  }
}
</script>
