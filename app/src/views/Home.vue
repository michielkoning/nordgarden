<template>
  <app-page title="Home">
    <biography-intro :read-more="true" />
    <tour-dates />
    <app-gallery />
    <latest-posts />
    <div class="mood"></div>
  </app-page>
</template>

<script>
import LatestPosts from '@/components/LatestPosts.vue';
import AppPage from '@/components/AppPage.vue';
import TourDates from '@/components/TourDates.vue';
import AppGallery from '@/components/AppGallery.vue';
import BiographyIntro from '@/components/BiographyIntro.vue';

export default {
  components: {
    LatestPosts,
    AppPage,
    TourDates,
    AppGallery,
    BiographyIntro,
  },
};
</script>

<style lang="postcss" scoped>
.wrapper {
  @mixin center;

  max-width: var(--container-width-xlg);
}

.mood {
  margin: 2em -2em 0 -22em;
  background: url('http://localhost:9030/wp-content/uploads/2012/10/Foto-1-Nordgarden-live-@-Ostello-Catania-07.10.2012.jpg')
    no-repeat;
  background-size: cover;
  height: 100vh;
  background-attachment: fixed;
}
</style>
