<template>
  <app-page>
    <div class="albums">
      <ul>
        <li v-for="album in list" :key="album.name" class="album">
          <div v-html="album.image"></div>
          <ul>
            <li v-for="song in album.songlist" :key="song.title">{{ song.title }}</li>
          </ul>
        </li>
      </ul>
    </div>
  </app-page>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    AppPage,
  },
  computed: {
    ...mapState('albums', ['list']),
  },

  mounted() {
    if (!this.list.length) this.setAlbums();
  },
  methods: {
    ...mapActions({
      setAlbums: 'albums/set',
    }),
  },
};
</script>

<style lang="postcss" scoped>
.album {
  display: grid;
  grid-gap: var(--gutter);
  grid-template-columns: 10em auto;
}

img {
  display: block;
  max-width: 100%;
}
</style>
