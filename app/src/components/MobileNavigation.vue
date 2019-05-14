<template>
  <div>
    <button :aria-expanded="menuIsExpanded" @click="toggleMenu">Show menu</button>
    <button v-if="!isPlaying" @click="playAudio(song)">
      <app-icon icon="play" :title="$t('play')"/>
    </button>
    <button v-else @click="pauseAudio">
      <app-icon icon="pause" :title="$t('pause')"/>
    </button>
  </div>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil';
import { mapState } from 'vuex';
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
  },

  methods: {
    toggleMenu() {
      this.menuIsExpanded = !this.menuIsExpanded;
      this.$emit('toggleMenu', this.menuIsExpanded);
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
}
</style>
