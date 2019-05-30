<template>
  <app-page class="content" :title="title">
    <youtube
      ref="youtube"
      :video-id="videoId"
      :player-vars="playerVars"
      :fit-parent="true"
      :resize-delay="10"
      :resize="true"
      @playing="playing"
    ></youtube>

    <ul>
      <li
        v-for="video in videos"
        :key="video.videoId"
        :class="{ 'is-active': isCurrentVideo(video) }"
        @click="playVideo(video.videoId)"
      >
        <div class="image-wrapper">
          <img
            :src="`https://img.youtube.com/vi/${video.videoId}/hqdefault.jpg`"
            alt
          />
          <icon-play aria-hidden="true" />
          <span class="sr-only">{{ $t('play') }}</span>
        </div>
        {{ video.title }}
      </li>
    </ul>
  </app-page>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil'
import { mapState } from 'vuex'
import IconPlay from '@/assets/icons/play.svg'
import AppPage from '@/components/AppPage.vue'

export default {
  components: {
    IconPlay,
    AppPage
  },
  meta: {
    step: 3
  },
  data() {
    return {
      title: this.$t('videos'),
      videos: [
        {
          videoId: 'bH67wt1CHv8',
          title: 'SIDE OF THE ROAD – (OFFICIAL VIDEO)'
        },
        {
          videoId: 'JRwpPplPqmM',
          title: 'SIDE OF THE ROAD – LIVE @ TV RAI 1'
        },
        {
          videoId: '3K-f6RVtKwA',
          title: 'YOU MUST BE THE CHANGE – (OFFICIAL VIDEO)'
        },
        {
          videoId: 'phujbtP9J_Y',
          title: 'A MERRY OLD CHRISTMAS – (OFFICIAL VIDEO)'
        },
        {
          videoId: '7qO4Lu5rxew',
          title: 'LA MIA RIVOLUZIONE – (OFFICIAL VIDEO)'
        },
        {
          videoId: 'Rc-fLsWAe_A',
          title: 'LA CANZONE DEI CANI – (OFFICIAL VIDEO)'
        },
        {
          videoId: '83OIrw0AjgY',
          title: 'NON È LA CALIFORNIA – (OFFICIAL VIDEO)'
        },
        {
          videoId: 'RA2dLa5ZAVY',
          title: 'L’ABBANDONO – LIVE @ ROMA – 06.12.13'
        },
        {
          videoId: 'ioYwLp2PKBY',
          title: 'THESE LOVESICK BLUES – (OFFICIAL VIDEO)'
        },
        {
          videoId: 'PBMpzxa-SJA',
          title: 'KEEP IT SHINING ON THE INSIDE – (OFFICIAL VIDEO)'
        },
        {
          videoId: '_SnVGrgAHmg',
          title: 'THE PATH OF LOVE – (OFFICIAL VIDEO)'
        },
        {
          videoId: '986m8vY9DVo',
          title: 'GOOD THINGS DIE – (OFFICIAL VIDEO)'
        }
      ],
      videoId: 'bH67wt1CHv8',
      playerVars: {
        rel: 0
      },
      isPlayingVideo: false
    }
  },
  computed: {
    ...mapState('albums', ['isPlaying']),

    player() {
      return this.$refs.youtube.player
    }
  },
  watch: {
    isPlaying(value) {
      if (value) {
        this.pauseVideo()
      }
    }
  },

  methods: {
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
    }
  },
  head() {
    return {
      title: this.title
    }
  }
}
</script>

<style lang="postcss" scoped>
img {
  width: 100%;
  display: block;
  margin-bottom: 0.25em;
}

.image-wrapper {
  position: relative;
}

svg {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 2em;
  height: 2em;
  margin: -1em 0 0 -1em;
  opacity: 0.7;
  transition: opacity 0.2s ease-out;
}

li {
  text-align: center;
  border: 2px solid transparent;
  border-bottom: 2px dashed var(--color-white);
  padding-bottom: 0.5em;

  &.is-active {
    border: 2px solid var(--color-white);
  }

  &:hover svg {
    opacity: 1;
  }
}

ul {
  @mixin list-reset;

  display: grid;
  grid-gap: 1em;
  grid-template-columns: repeat(auto-fit, minmax(10em, 1fr));
}

>>> iframe {
  width: 100%;
  display: block;
  margin-bottom: 1em;
}
</style>
