<template>
  <app-page title="Albums">
    <ul class="albums-list">
      <li v-for="album in list" :key="album.name" class="album">
        <h2>{{ album.title }}</h2>
        <div>
          <div v-html="album.image"></div>
        </div>
        <div>
          <ul class="songlist">
            <li
              v-for="song in album.songlist"
              :key="song.title"
              class="song"
              @click="playSong(song)"
            >
              {{ song.title }}
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </app-page>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import AppPage from '@/components/AppPage.vue';
import EventBusUtil from '@/utils/eventBusUtil';

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
    playSong(song) {
      EventBusUtil.$emit('audio-play-song', song);
    },
  },
};
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;
}

h2 {
  margin: 0;
  grid-column: 1 / -1;
}

.album {
  display: grid;
  grid-gap: var(--gutter);
  grid-template-columns: 10em auto;
  margin-bottom: 2em;
}

img {
  display: block;
  max-width: 100%;
}

.songlist {
  max-width: var(--container-width-sm);
  border-top: 1px solid #ccc;
}

.song {
  padding: 0.1em 0;
  border-bottom: 1px solid #ccc;
}
</style>
