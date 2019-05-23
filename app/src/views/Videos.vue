<template>
  <app-page class="content" title="Videos">
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
          <img :src="`https://img.youtube.com/vi/${video.videoId}/hqdefault.jpg`" alt />
          <app-icon icon="play" :title="$t('play')" />
        </div>
        {{ video.title }}
      </li>
    </ul>
  </app-page>
</template>

<script>
import AppPage from '@/components/AppPage.vue';
import EventBusUtil from '@/utils/eventBusUtil';
import { mapState } from 'vuex';
import AppIcon from '@/components/AppIcon.vue';

export default {
  components: {
    AppPage,
    AppIcon,
  },
  data() {
    return {
      videos: [
        {
          videoId: 'bH67wt1CHv8',
          title: 'Side of the road',
        },
        {
          videoId: 'JRwpPplPqmM',
          title: 'Side of the road (live @ TV Rai)',
        },
        {
          videoId: '3K-f6RVtKwA',
          title: 'title',
        },
        {
          videoId: 'phujbtP9J_Y',
          title: 'title',
        },
        {
          videoId: '7qO4Lu5rxew',
          title: 'title',
        },
        {
          videoId: 'Rc-fLsWAe_A',
          title: 'title',
        },
        {
          videoId: '83OIrw0AjgY',
          title: 'title',
        },
        {
          videoId: 'RA2dLa5ZAVY',
          title: 'title',
        },
        {
          videoId: 'ioYwLp2PKBY',
          title: 'title',
        },
        {
          videoId: 'PBMpzxa-SJA',
          title: 'title',
        },
        {
          videoId: '_SnVGrgAHmg',
          title: 'title',
        },
        {
          videoId: '986m8vY9DVo',
          title: 'title',
        },
      ],
      videoId: 'bH67wt1CHv8',
      playerVars: {
        rel: 0,
      },
      isPlayingVideo: false,
    };
  },
  watch: {
    isPlaying(value) {
      if (value) {
        this.pauseVideo();
      }
    },
  },
  computed: {
    ...mapState('albums', ['isPlaying']),

    player() {
      return this.$refs.youtube.player;
    },
  },
  methods: {
    playVideo(videoId) {
      this.videoId = videoId;
      this.$nextTick(() => {
        this.player.playVideo();
      });
    },
    pauseVideo() {
      this.player.pauseVideo();
    },
    isCurrentVideo(video) {
      return this.videoId === video.videoId;
    },

    playing() {
      EventBusUtil.$emit('audio-play-song', false);
    },
  },
};
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

  &.is-active {
    border-color: #fff;
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
