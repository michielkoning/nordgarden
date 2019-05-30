<template>
  <app-page :title="title">
    <biography-intro :read-more="true" />
    <section aria-labelledby="tour-title">
      <h1 id="tour-title">{{ $t('tour') }}</h1>
      <tour-dates />
    </section>
    <app-gallery />
    <latest-posts />
    <div class="mood">
      <img src="/images/mood.jpg" alt />
    </div>
  </app-page>
</template>

<script>
import LatestPosts from '@/components/LatestPosts.vue'
import TourDates from '@/components/TourDates.vue'
import AppGallery from '@/components/AppGallery.vue'
import BiographyIntro from '@/components/BiographyIntro.vue'
import AppPage from '@/components/AppPage.vue'

export default {
  components: {
    LatestPosts,
    TourDates,
    AppGallery,
    BiographyIntro,
    AppPage
  },
  meta: {
    step: 0
  },
  data() {
    return {
      title: this.$t('home')
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
.wrapper {
  @mixin center;

  max-width: var(--container-width-xlg);
}

.mood {
  margin: 0 calc(var(--gutter) * -1);
}

img {
  width: 100%;
  display: block;
}
</style>
