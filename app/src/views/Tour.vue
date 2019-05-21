<template>
  <app-page class="tour">
    <div class="text">
      <tour-dates />
    </div>
    <img src="/img/tour.jpg" alt />
  </app-page>
</template>

<script>
import AppPage from '@/components/AppPage.vue';
import TourDates from '@/components/TourDates.vue';

export default {
  components: {
    AppPage,
    TourDates,
  },
};
</script>

<style lang="postcss" scoped>
.tour {
  background: #2f2e3e;
  color: #fff;
  display: flex;
  align-items: flex-start;
  font-size: 1.2em;
}

img {
  flex: 0 0 auto;
  height: auto;
  margin-left: 5rem;
}
</style>
