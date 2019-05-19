<template>
  <app-page class="content" title="Videos">
    <youtube :video-id="videoId" ref="youtube" :player-vars="playerVars"  @playing="playing" :fitParent="true" :resizeDelay="10" :resize="true" ></youtube>

    <ul>
      <li v-for="video in videos" :key="video" @click="playVideo(video)">
        <img :src="`https://img.youtube.com/vi/${video}/hqdefault.jpg`" alt />
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

export default {
  components: {
    AppPage,
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
    playing() {
      EventBusUtil.$emit('audio-play-song', false);
    }
  },  

};
</script>

<style lang="postcss" scoped>
.wrapper2 {
  @mixin center;
}

img {
  width: 100%;
  display: block;
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
