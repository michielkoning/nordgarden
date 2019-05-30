<template>
  <app-page :title="title">
    <div class="tour">
      <tour-dates />
      <img src="/images/tour.jpg" alt />
    </div>
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
}
</script>

<style lang="postcss" scoped>
.tour {
  display: flex;
  flex-direction: column;
  align-items: flex-start;

  @media (--viewport-lg) {
    flex-direction: row;
  }
}

img {
  flex: 0 1 auto;
  align-self: flex-end;
  @media (--viewport-lg) {
    margin-left: 5rem;
  }
}
</style>
