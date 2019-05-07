<template>
  <div class="albums">
    <ul>
      <li v-for="album in albums" :key="album.name" class="album">
        <div v-html="album.image"></div>
        <ul>
          <li v-for="song in album.songlist" :key="song.title">{{ song.title }}</li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      albums: [],
      isLoading: false,
    };
  },
  mounted() {
    this.getAlbums();
  },
  methods: {
    async getAlbums() {
      this.loading = true;
      try {
        const response = await axios.get('site/v1/discography');
        this.albums = response.data;
      } catch (error) {
        window.console.error(error);
      } finally {
        this.loading = false;
      }
    },
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
