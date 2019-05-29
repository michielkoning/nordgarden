<template>
  <app-page :title="title">
    <ul v-if="list.length" class="albums-list">
      <app-album v-for="album in list" :key="album.name" :album="album" />
    </ul>
  </app-page>
</template>

<script>
import { mapState } from 'vuex'
import AppAlbum from '@/components/AppAlbum.vue'
import AppPage from '@/components/AppPage.vue'

export default {
  components: {
    AppAlbum,
    AppPage
  },
  meta: {
    step: 2
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
    return {
      title: this.title
    }
  }
}
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;
}
</style>
