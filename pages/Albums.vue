<template>
  <div title="Albums">
    <ul v-if="list.length" class="albums-list">
      <app-album v-for="album in list" :key="album.name" :album="album" />
    </ul>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import AppAlbum from '@/components/AppAlbum.vue'

export default {
  components: {
    AppAlbum
  },
  computed: {
    ...mapState('albums', ['list'])
  }
}
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;
}
</style>
