<template>
  <app-page title="Nordgarden">
    <tour-dates />
    <app-gallery />
    <latest-posts />
  </app-page>
</template>

<script>
import LatestPosts from '@/components/LatestPosts.vue';
import AppPage from '@/components/AppPage.vue';
import TourDates from '@/components/TourDates.vue';
import AppGallery from '@/components/AppGallery.vue';

export default {
  components: {
    LatestPosts,
    AppPage,
    TourDates,
    AppGallery,
  },
};
</script>

<style lang="postcss" scoped>
.wrapper {
  @mixin center;

  margin-bottom: 3em;
  max-width: var(--container-width-xlg);
}
</style>
