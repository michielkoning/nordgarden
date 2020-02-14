<template>
  <app-page :title="title">
    <ul v-if="list.length" class="albums-list">
      <app-album v-for="album in list" :key="album.name" :album="album" />
    </ul>
  </app-page>
</template>

<script>
import { mapState } from 'vuex'
import AppAlbum from '~/components/AppAlbum.vue'
import AppPage from '~/components/AppPage.vue'
import getSeoMetaData from '~/helpers/seo'

export default {
  components: {
    AppAlbum,
    AppPage
  },

  data() {
    return {
      title: this.$t('albums')
    }
  },
  computed: {
    ...mapState('albums', ['list'])
  },
  head() {
    const { title } = this
    const slug = 'albums'
    const metaDesc = 'The new album KORSVEI is out!'
    return getSeoMetaData(title, metaDesc, slug)
  }
}
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;
}
</style>
