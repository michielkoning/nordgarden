<template>
  <div v-show="songs.length" class="player">
    <button v-if="!isPlaying" @click="play">►</button>
    <button v-if="isPlaying" @click="pause">❚ ❚</button>
    <button @click="next">►►</button>
    <div ref="progress" class="progress" @click="scrub">
      <div class="bar" :style="{ width: progress }"></div>
      <div v-if="song">{{ song.title }}</div>
      <div v-else>test</div>
    </div>
    <audio
      ref="audio"
      :src="song.file"
      @timeupdate="timeupdate"
      @play="setPlayState(true)"
      @pause="setPlayState(false)"
      @ended="next"
    ></audio>
    {{ currentSong }}
  </div>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil';
import { mapActions, mapGetters, mapState } from 'vuex';

export default {
  data() {
    return {
      songIndex: 1,
      player: null,
      song: '',
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
    EventBusUtil.$on('audio-play-song', song => this.playSong(song));
    this.$nextTick(() => {
      this.player = this.$refs.audio;
    });
  },
  methods: {
    ...mapActions({
      setPlayState: 'albums/setPlayState',
    }),
    pause() {
      this.player.pause();
    },
    play() {
      this.player.play();
    },
    next() {
      this.playSong();
    },
    scrub(event) {
      const progress = this.$refs.progress;
      const scrubTime = (event.offsetX / progress.offsetWidth) * this.player.duration;
      this.player.currentTime = scrubTime;
    },
    timeupdate() {
      this.progress = `${(this.player.currentTime / this.player.duration) * 100}%`;
    },
    // playSong(song) {
    //   this.song = song;
    //   this.songIndex += 1;
    //   if (this.songIndex === 11) this.songIndex = 1;
    //   this.$nextTick(() => {
    //     this.player.play();
    //   });
    // },
  },
};
</script>

<style lang="postcss" scoped>
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
  flex: 1 1 auto;
}

.bar {
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.2);
}
</style>
