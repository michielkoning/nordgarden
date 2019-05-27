<template>
  <div class="player">
    <button v-if="isPlaying" :disabled="!songs.length" @click="pause">
      <app-icon icon="pause" :title="$t('pause')" />
    </button>
    <button v-else :disabled="!songs.length" @click="play">
      <app-icon icon="play" :title="$t('play')" />
    </button>
    <button :disabled="songs.length < 1" @click="next">
      <app-icon icon="forwards" :title="$t('next')" />
    </button>
    <div v-show="songs.length" ref="progress" class="progress" @click="scrub">
      <div class="bar" :style="{ width: progress }"></div>
      <div class="title">{{ currentSong.title }}</div>
    </div>
    <audio
      id="audio"
      ref="audio"
      :src="currentSong.file"
      @timeupdate="timeupdate"
      @ended="next"
      @play="setPlayState(true)"
      @pause="setPlayState(false)"
    ></audio>
  </div>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil';
import { mapActions, mapGetters, mapState } from 'vuex';
import AppIcon from '@/components/AppIcon.vue';

export default {
  components: {
    AppIcon,
  },
  data() {
    return {
      songIndex: 1,
      player: null,
      progress: 0,
    };
  },
  computed: {
    ...mapState('albums', ['currentSong', 'isPlaying']),
    ...mapGetters({
      songs: 'albums/playableSongs',
    }),
  },

  created() {
    EventBusUtil.$on('audio-play-song', state => (state ? this.play() : this.pause()));
    this.$nextTick(() => {
      this.player = this.$refs.audio;
    });
  },
  methods: {
    ...mapActions({
      setPlayState: 'albums/setPlayState',
      selectNextSong: 'albums/selectNextSong',
    }),
    pause() {
      this.player?.pause();
    },
    play() {
      this.player?.play();
    },
    next() {
      this.selectNextSong().then(() => {
        this.player?.play();
      });
    },
    scrub(event) {
      const progress = this.$refs.progress;
      const scrubTime = (event.offsetX / progress.offsetWidth) * this.player.duration;
      this.player.currentTime = scrubTime;
    },
    timeupdate() {
      this.progress = `${(this.player.currentTime / this.player.duration) * 100}%`;
    },
  },
};
</script>

<style lang="postcss" scoped>
.player {
  margin-bottom: 2em;
  display: flex;
}

audio {
  width: 100%;
}

button {
  text-align: center;
  margin-right: 1em;
  display: flex;
  justify-content: center;
  align-items: center;
}

.progress {
  position: relative;
  flex: 1 0 auto;
  cursor: pointer;
}

.title {
  max-width: 12rem;
  font-size: 0.8em;
  white-space: nowrap;
  overflow: hidden;
  position: relative;
  text-overflow: ellipsis;
}

.bar {
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  background: var(--color-primary);
}
</style>
