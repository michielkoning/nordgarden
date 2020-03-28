<template>
  <div class="videos">
    <div class="player">
      <youtube
        ref="youtube"
        :video-id="videoId"
        :player-vars="playerVars"
        :fit-parent="true"
        :resize-delay="10"
        :resize="true"
        @playing="playing"
      ></youtube>
    </div>

    <ul class="list">
      <li
        v-for="video in videos"
        :key="video.videoId"
        :class="{ 'is-active': isCurrentVideo(video) }"
        class="list-item"
        @mousedown="mouseDown"
        @mouseup="mouseUp(video.videoId)"
      >
        <div class="image-wrapper">
          <img
            :src="`https://img.youtube.com/vi/${video.videoId}/hqdefault.jpg`"
            width="480"
            height="360"
            loading="lazy"
            alt
          />
          <icon-play aria-hidden="true" />
        </div>
        <button class="btn-video" @click="playVideo(video.videoId)">
          <span class="sr-only">{{ $t('play') }}</span>
          {{ video.title }}
        </button>
      </li>
    </ul>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import EventBusUtil from '~/utils/eventBusUtil'
import IconPlay from '~/assets/icons/play.svg'
import videos from '~/data/videos'

export default {
  components: {
    IconPlay,
  },

  props: {
    videos: {
      type: Array,
      required: true,
    },
  },

  data() {
    return {
      videoId: videos[0].videoId,
      playerVars: {
        rel: 0,
      },
      isPlayingVideo: false,
      down: null,
    }
  },
  computed: {
    ...mapState('albums', ['isPlaying']),

    player() {
      return this.$refs.youtube.player
    },
  },
  watch: {
    isPlaying(value) {
      if (value) {
        this.pauseVideo()
      }
    },
  },
  methods: {
    mouseUp(videoId) {
      const up = +new Date()
      if (up - this.down < 200) {
        this.playVideo(videoId)
      }
    },
    mouseDown() {
      this.down = +new Date()
    },
    goToPost() {
      this.$router.push(this.post.slug)
    },
    playVideo(videoId) {
      this.videoId = videoId
      this.$nextTick(() => {
        this.player.playVideo()
      })
    },
    pauseVideo() {
      this.player.pauseVideo()
    },
    isCurrentVideo(video) {
      return this.videoId === video.videoId
    },

    playing() {
      EventBusUtil.$emit('audio-play-song', false)
    },
  },
}
</script>

<style lang="postcss" scoped>
@custom-media --video-tiles (--viewport-sm);

img {
  width: 100%;
  display: block;
  margin-bottom: var(--spacing-xxs);
}

.image-wrapper {
  position: relative;
}

svg {
  --video-button-size: var(--spacing-m);

  @media (--video-tiles) {
    --video-button-size: var(--spacing-l);
  }

  position: absolute;
  left: 50%;
  top: 50%;
  width: var(--video-button-size);
  height: var(--video-button-size);

  /* prettier-ignore */
  margin:
    calc(var(--video-button-size) / -2) 0 0
    calc(var(--video-button-size) / -2);
  fill: var(--color-white);
}

.list-item {
  border: 2px solid transparent;
  border-bottom: 2px dashed var(--color-primary);
  padding-bottom: var(--spacing-xs);
  display: grid;
  grid-gap: var(--spacing-m);
  grid-template-columns: 5em auto;

  &:hover,
  &:focus-within,
  &.is-active {
    border-style: solid;
  }

  @media (--video-tiles) {
    display: block;
  }
}

.btn-video {
  text-align: left;

  @media (--video-tiles) {
    text-align: center;
  }
}

.videos {
  max-width: 48em;
}

.list {
  @mixin list-reset;

  display: grid;
  grid-gap: var(--spacing-m);

  @media (--video-tiles) {
    grid-template-columns: repeat(auto-fit, minmax(10em, 1fr));
  }
}

>>> iframe {
  width: 100%;
  display: block;
  margin-bottom: var(--spacing-m);
}

.btn-video:focus {
  outline: none;
}
</style>
