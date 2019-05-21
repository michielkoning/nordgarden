<template>
  <app-loader v-if="isLoading" />
  <app-page v-else title="Albums">
    <ul v-if="list.length" class="albums-list">
      <app-album v-for="album in list" :key="album.name" :album="album" />
    </ul>
  </app-page>
</template>

<script>
import { mapState } from 'vuex';
import AppPage from '@/components/AppPage.vue';
import AppLoader from '@/components/AppLoader.vue';
import AppAlbum from '@/components/AppAlbum.vue';

export default {
  components: {
    AppPage,
    AppLoader,
    AppAlbum,
  },
  computed: {
    ...mapState('albums', ['list', 'isLoading']),
  },
};
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;
}
</style>
