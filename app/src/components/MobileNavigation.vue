<template>
  <div>
    <button :aria-expanded="menuIsExpanded" @click="toggleMenu(!menuIsExpanded)">Show menu</button>
    <template v-if="songs.length">
      <button v-if="isPlaying" @click="pauseAudio">
        <app-icon icon="pause" :title="$t('pause')" />
      </button>
      <button v-else @click="playAudio()">
        <app-icon icon="play" :title="$t('play')" />
      </button>
    </template>
  </div>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil';
import { mapState, mapGetters } from 'vuex';
import AppIcon from '@/components/AppIcon.vue';

export default {
  components: {
    AppIcon,
  },
  data() {
    return {
      menuIsExpanded: false,
    };
  },
  computed: {
    ...mapState('albums', ['isPlaying']),
    ...mapGetters({
      songs: 'albums/playableSongs',
    }),
  },
  watch: {
    $route() {
      this.toggleMenu(false);
    },
  },

  methods: {
    toggleMenu(status) {
      this.menuIsExpanded = status;
      this.$emit('toggleMenu', status);
    },
    pauseAudio() {
      EventBusUtil.$emit('audio-play-song', false);
    },
    playAudio() {
      EventBusUtil.$emit('audio-play-song', true);
    },
  },
};
</script>

<style lang="postcss" scoped>
div {
  position: fixed;
  padding: var(--gutter);
  top: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: space-between;
  background: var(--color-white);
  z-index: var(--mobile-navigation);

  @media (--navigation-position-left) {
    display: none;
  }
}
</style>
