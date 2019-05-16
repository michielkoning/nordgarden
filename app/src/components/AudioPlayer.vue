<template>
  <div v-show="songs.length" class="player">
    <button v-if="isPlaying" @click="pause">
      <app-icon icon="pause" :title="$t('pause')" />
    </button>
    <button v-else @click="play">
      <app-icon icon="play" :title="$t('play')" />
    </button>
    <button @click="next">
      <app-icon icon="forwards" :title="$t('next')" />
    </button>
    <div ref="progress" class="progress" @click="scrub">
      <div class="bar" :style="{ width: progress }"></div>
      <div class="title">{{ currentSong.title }}</div>
    </div>
    <audio
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
  margin-bottom: 1em;
}

audio {
  width: 100%;
}

.player {
  display: flex;
}

button {
  flex: 0 0 2em;
  text-align: center;
}

.progress {
  position: relative;
  text-align: center;
  flex: 1 0 auto;
}

.title {
  max-width: 16em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.bar {
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.2);
}
</style>
