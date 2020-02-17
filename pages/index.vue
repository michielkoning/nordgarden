<template>
  <app-page :title="title">
    <biography-intro />
    <section aria-labelledby="tour-title">
      <h1 id="tour-title">{{ $t('tour') }}</h1>
      <tour-dates />
    </section>
    <app-gallery />
    <latest-posts />
  </app-page>
</template>

<script>
import LatestPosts from '~/components/Posts/LatestPosts.vue'
import TourDates from '~/components/Tour/TourDates.vue'
import AppGallery from '~/components/Home/AppGallery.vue'
import BiographyIntro from '~/components/Biography/BiographyIntro.vue'
import AppPage from '~/components/Layout/AppPage.vue'
import getSeoMetaData from '~/helpers/seo'

export default {
  components: {
    LatestPosts,
    TourDates,
    AppGallery,
    BiographyIntro,
    AppPage
  },

  data() {
    return {
      title: this.$t('home')
    }
  },

  head() {
    const title = this.$t('home')
    const metaDesc =
      'Nordgarden is a Norwegian artist deriving from the American old school of classic songwriting.'

    return getSeoMetaData(title, metaDesc, '')
  }
}
</script>

<style lang="postcss" scoped>
.wrapper {
  @mixin center;

  max-width: var(--container-width-xlg);
}

img {
  width: 100%;
  display: block;
}
</style>
