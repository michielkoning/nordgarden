<template>
  <div class="player">
    <button v-if="isPlaying" :disabled="!songs.length" @click="pause">
      <icon-pause width="24" height="24" aria-hidden="true" />
      <span class="sr-only">{{ $t('pause') }}</span>
    </button>
    <button v-else :disabled="!songs.length" @click="play">
      <icon-play width="24" height="24" aria-hidden="true" />
      <span class="sr-only">{{ $t('play') }}</span>
    </button>
    <button :disabled="songs.length < 1" @click="next">
      <icon-forwards width="24" height="24" aria-hidden="true" />
      <span class="sr-only">{{ $t('next') }}</span>
    </button>
    <div v-show="songs.length" ref="progress" class="progress" @click="scrub">
      <div :style="{ width: progress }" class="bar"></div>
      <div v-if="currentSong" class="title">{{ currentSong.title }}</div>
    </div>
    <audio
      ref="audio"
      :src="currentSongFile"
      :preload="preload"
      @timeupdate="timeupdate"
      @ended="next"
      @play="setPlayState(true)"
      @pause="setPlayState(false)"
    />
  </div>
</template>

<script>
import { mapActions, mapGetters, mapState } from 'vuex'
import EventBusUtil from '~/utils/eventBusUtil'

import IconPlay from '~/assets/icons/play.svg'
import IconPause from '~/assets/icons/pause.svg'
import IconForwards from '~/assets/icons/forwards.svg'

export default {
  components: {
    IconPlay,
    IconPause,
    IconForwards,
  },
  data() {
    return {
      songIndex: 1,
      player: null,
      progress: 0,
      preload: 'none',
    }
  },
  computed: {
    ...mapState('albums', ['currentSong', 'isPlaying']),
    ...mapGetters({
      songs: 'albums/playableSongs',
    }),
    currentSongFile() {
      if (!this.currentSong) return null
      return this.currentSong.file
    },
  },

  created() {
    EventBusUtil.$on('audio-play-song', (state) =>
      state ? this.play() : this.pause(),
    )
    this.$nextTick(() => {
      this.player = this.$refs.audio
    })
    this.selectSong(this.songs[0])
    this.addMetaData()
    this.mediaSessionEventListeners()
    this.setPreloadOnFastConnection()
  },
  methods: {
    userHasFastConnection() {
      if (!process.client) return false
      const connection =
        window.navigator.connection ||
        window.navigator.mozConnection ||
        window.navigator.webkitConnection
      if (!connection) return false

      const slowConnections = ['slow-2g', '2g', '3g']
      return !slowConnections.includes(connection.effectiveType)
    },
    setPreloadOnFastConnection() {
      if (this.userHasFastConnection()) {
        this.preload = 'auto'
      } else {
        this.preload = 'none'
      }
    },
    ...mapActions({
      setPlayState: 'albums/setPlayState',
      selectNextSong: 'albums/selectNextSong',
      selectPreviousSong: 'albums/selectPreviousSong',
      selectSong: 'albums/selectSong',
    }),
    pause() {
      this.player.pause()
    },
    play() {
      this.player.play()
    },
    async previous() {
      await this.selectPreviousSong(this.currentSong)
      this.player.play()
      this.updateMetaData()
    },
    async next() {
      await this.selectNextSong(this.currentSong)
      this.player.play()
      this.updateMetaData()
    },
    updateMetaData() {
      navigator.mediaSession.metadata.title = this.currentSong.title
      navigator.mediaSession.metadata.album = this.currentSong.album.title
      const sizes = [96, 128, 192, 256, 384, 512]
      const artwork = sizes.map((size) => {
        return {
          src: `/media/albums/${this.currentSong.album.image}/${size}.png`,
          sizes: `${size}x${size}`,
          type: 'image/png',
        }
      })
      navigator.mediaSession.metadata.artwork = artwork
    },
    scrub(event) {
      const progress = this.$refs.progress
      const scrubTime =
        (event.offsetX / progress.offsetWidth) * this.player.duration
      this.player.currentTime = scrubTime
    },
    timeupdate() {
      this.progress = `${
        (this.player.currentTime / this.player.duration) * 100
      }%`
    },
    addMetaData() {
      if (!process.client) return
      if (!('mediaSession' in window.navigator)) return
      // eslint-disable-next-line no-undef
      navigator.mediaSession.metadata = new MediaMetadata({
        artist: 'Nordgarden',
      })
      this.updateMetaData()
    },
    mediaSessionEventListeners() {
      if (!process.client) return
      if (!('mediaSession' in window.navigator)) return
      navigator.mediaSession.setActionHandler('pause', () => {
        this.pause()
      })
      navigator.mediaSession.setActionHandler('play', () => {
        this.play()
      })
      navigator.mediaSession.setActionHandler('seekbackward', (details) => {
        this.player.currentTime =
          this.player.currentTime - (details.seekOffset || 10)
      })
      navigator.mediaSession.setActionHandler('seekforward', (details) => {
        this.player.currentTime =
          this.player.currentTime + (details.seekOffset || 10)
      })
      navigator.mediaSession.setActionHandler('previoustrack', () => {
        this.previous()
      })

      navigator.mediaSession.setActionHandler('nexttrack', () => {
        this.next()
      })
    },
  },
}
</script>

<style lang="postcss" scoped>
.player {
  margin-bottom: var(--spacing-l);
  display: flex;
}

audio {
  width: 100%;
}

button {
  text-align: center;
  margin-right: var(--spacing-m);
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
  padding: 0 var(--spacing-xxs);
  font-size: var(--font-size-sm);
  white-space: nowrap;
  overflow: hidden;
  position: relative;
  text-overflow: ellipsis;
}

.bar {
  transition: width linear 0.1s;
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  background: var(--color-primary);
}
</style>
