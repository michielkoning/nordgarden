<template>
  <app-page title="Albums">
    <ul v-if="list.length" class="albums-list">
      <app-album v-for="album in list" :key="album.name" :album="album" />
    </ul>
  </app-page>
</template>

<script>
import { mapState } from 'vuex';
import AppPage from '@/components/AppPage.vue';
import AppAlbum from '@/components/AppAlbum.vue';

export default {
  components: {
    AppPage,
    AppAlbum,
  },
  computed: {
    ...mapState('albums', ['list']),
  },
};
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;
}
</style>
