<template>
  <app-loader v-if="isLoading" />
  <app-page v-else title="Albums">
    <ul v-if="list.length" class="albums-list">
      <li v-for="album in list" :key="album.name" class="album">
        <h2>{{ album.title }}</h2>
        <div>
          <div v-html="album.image"></div>
          {{ album.release_date | formatDate }}
            <ul class="shops">
              <li>
                <a href="#">
                  <app-icon
                    icon="spotify"
                    width="24"
                    height="24"
                    :title="`${'viewNordgardenOn'} spotify`"
                  />
                </a>
              </li>
              <li>
                <a href="#">
                  <app-icon
                    icon="apple"
                    width="24"
                    height="24"
                    :title="`${'viewNordgardenOn'} apple`"
                  />
                </a>
              </li>
            </ul>
        </div>
        <div>
          <ul class="songlist">
            <li v-for="song in album.songlist" :key="song.title" class="song">
              <template\ v-if="song.file">
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
  filters: {
    formatDate(value) {
      const date = new Date(value);
      return `${date.getDate()}.${date.getMonth() + 1}.${date.getFullYear()}`;
    },
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
  margin-bottom: 2em;

  @media (--viewport-sm) {
    grid-template-columns: 10em auto;
  }
}
>>> img {
  display: block;
  max-width: 10em;
  width: 100%;
  @media (--viewport-sm) {
    max-width: none;
  }
}

.songlist {
  max-width: var(--container-width-sm);
  border-top: 1px solid #ccc;
}

.song {
  padding: 0.1em 0;
  border-bottom: 1px solid #ccc;
}

.shops {
    display: flex;
}

a {
  flex: 0 0 1em;
  margin-right: 0.5em;
}
</style>
