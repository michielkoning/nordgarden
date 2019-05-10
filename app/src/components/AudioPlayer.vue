<template>
  <div class="player">
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
      :src="file"
      @timeupdate="timeupdate"
      @play="updateIsPlayingStatus(true)"
      @pause="updateIsPlayingStatus(false)"
      @ended="next"
    ></audio>
  </div>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil';

export default {
  data() {
    return {
      songIndex: 1,
      player: null,
      isPlaying: false,
      song: '',
      progress: 0,
    };
  },
  computed: {
    file() {
      return `/audio/${this.songIndex}.mp3`;
    },
  },
  created() {
    this.$nextTick(() => {
      this.player = this.$refs.audio;
    });
    EventBusUtil.$on('audio-play-song', song => this.playSong(song));
  },
  methods: {
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
    updateIsPlayingStatus(status) {
      this.isPlaying = status;
    },
    timeupdate() {
      this.progress = `${(this.player.currentTime / this.player.duration) * 100}%`;
    },
    playSong(song) {
      this.song = song;
      this.songIndex += 1;
      if (this.songIndex === 11) this.songIndex = 1;
      this.$nextTick(() => {
        this.player.play();
      });
    },
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
