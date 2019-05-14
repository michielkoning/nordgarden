<template>
  <app-loader v-if="isLoading" />
  <app-page v-else title="Albums">
    <ul v-if="list.length" class="albums-list">
      <li v-for="album in list" :key="album.name" class="album">
        <h2>{{ album.title }}</h2>
        <div>
          <div v-html="album.image"></div>
        </div>
        <div>
          <ul class="songlist">
            <li v-for="song in album.songlist" :key="song.title" class="song">
              <template v-if="song.file">
                <button v-if="!isPlayingCurrentSong(song)" @click="play(song)">
                  <app-icon icon="play" :title="$t('play')" />
                </button>
                <button v-else @click="pause">
                  <app-icon icon="pause" :title="$t('pause')" />
                </button>
              </template>
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
import AppIcon from '@/components/AppIcon.vue';
import AppLoader from '@/components/AppLoader.vue';

export default {
  components: {
    AppPage,
    AppIcon,
    AppLoader,
  },
  computed: {
    ...mapState('albums', ['list', 'currentSong', 'isPlaying', 'isLoading']),
  },

  methods: {
    ...mapActions({
      selectSong: 'albums/selectSong',
      setPlayState: 'albums/setPlayState',
    }),
    isPlayingCurrentSong(song) {
      return song === this.currentSong && this.isPlaying;
    },
    play(song) {
      this.selectSong(song).then(() => {
        EventBusUtil.$emit('audio-play-song', true);
      });
    },
    pause() {
      EventBusUtil.$emit('audio-play-song', false);
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
