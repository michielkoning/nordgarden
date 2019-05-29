<template>
  <app-page :title="title" class="tour">
    <div class="text">
      <tour-dates />
    </div>
    <img src="/img/tour.jpg" alt />
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
  meta: {
    step: 1
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
  // async fetch({ store, params }) {
  //   await store.dispatch('tour/set')
  // }
}
</script>

<style lang="postcss" scoped>
img {
  flex: 0 0 auto;
  height: auto;
  margin-left: 5rem;
}
</style>
