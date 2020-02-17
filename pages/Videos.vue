<template>
  <app-page :title="title" class="content">
    <videos-list :videos="videos" />
  </app-page>
</template>

<script>
import AppPage from '~/components/Layout/AppPage.vue'
import VideosList from '~/components/Videos/VideosList.vue'
import getSeoMetaData from '~/helpers/seo'
import videos from '~/data/videos'

export default {
  components: {
    AppPage,
    VideosList
  },

  data() {
    return {
      title: this.$t('videos'),
      videos
    }
  },

  head() {
    const { title } = this
    const slug = 'videos'
    const metaDesc = 'New music video for TANGO!'
    return getSeoMetaData(title, metaDesc, slug)
  }
}
</script>
