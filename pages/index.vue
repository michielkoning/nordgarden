<template>
  <div>
    <biography-intro :read-more="true" />
    <section aria-labelledby="tour-title">
      <h1 id="tour-title">{{ $t('tour') }}</h1>
      <tour-dates />
    </section>
    <app-gallery />
    <latest-posts />
    <div class="mood"></div>
  </div>
</template>

<script>
import LatestPosts from '@/components/LatestPosts.vue'
import TourDates from '@/components/TourDates.vue'
import AppGallery from '@/components/AppGallery.vue'
import BiographyIntro from '@/components/BiographyIntro.vue'

export default {
  components: {
    LatestPosts,
    TourDates,
    AppGallery,
    BiographyIntro
  },
  head() {
    return {
      title: 'Home',
      meta: [
        // hid is used as unique identifier. Do not use `vmid` for it as it will not work
        {
          hid: 'description',
          name: 'description',
          content: 'My custom description'
        }
      ]
    }
  }
}
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
