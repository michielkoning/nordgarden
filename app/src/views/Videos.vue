<template>
  <app-page class="content" title="Videos">
    <youtube :video-id="videoId" ref="youtube" :player-vars="playerVars"  @playing="playing" :fitParent="true" :resizeDelay="10" :resize="true" ></youtube>

    <ul>
      <li v-for="video in videos" :key="video" @click="playVideo(video)"
      
      :class="{ 'is-active': isCurrentVideo(video) }">
        <div class="image-wrapper">
          <img :src="`https://img.youtube.com/vi/${video}/hqdefault.jpg`" alt />
          <app-icon icon="play" :title="$t('play')" />
        </div>
        title of the video
        
      </li>
    </ul>
  </app-page>
</template>

<script>
import AppPage from '@/components/AppPage.vue';
import scriptjs from 'scriptjs';
import VueYoutube from 'vue-youtube' 
import EventBusUtil from '@/utils/eventBusUtil';
import { mapState } from 'vuex';
import AppIcon from '@/components/AppIcon.vue';

export default {
  components: {
    AppPage,
    AppIcon
  },
  data() {
    return {
      videos: [
        'bH67wt1CHv8',
        'JRwpPplPqmM',
        '3K-f6RVtKwA',
        'phujbtP9J_Y',
        '7qO4Lu5rxew',
        'Rc-fLsWAe_A',
        '83OIrw0AjgY',
        'RA2dLa5ZAVY',
        'ioYwLp2PKBY',
        'PBMpzxa-SJA',
        '_SnVGrgAHmg',
        '986m8vY9DVo',
      ],
      videoId: 'bH67wt1CHv8',
      playerVars: {
        rel: 0
      }      
    };
  },
  watch: {
    isPlaying(value) {
      if (value) {
        this.pauseVideo();
      }
    }
  },
  computed: {
    ...mapState('albums', ['isPlaying']),

    player() {
      return this.$refs.youtube.player
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
      return this.videoId === video;
    },
    playing() {
      EventBusUtil.$emit('audio-play-song', false);
    }
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

  &.is-active {
    border: 1px solid #fff;
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
