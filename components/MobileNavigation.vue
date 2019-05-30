<template>
  <div>
    <button
      :aria-expanded="menuIsExpanded"
      @click="toggleMenu(!menuIsExpanded)"
    >
      Show menu
    </button>
    <template v-if="songs.length">
      <button v-if="isPlaying" @click="pauseAudio">
        <icon-pause width="24" height="24" aria-hidden="true" />
        <span class="sr-only">{{ $t('pause') }}</span>
      </button>
      <button v-else @click="playAudio()">
        <icon-play width="24" height="24" aria-hidden="true" />
        <span class="sr-only">{{ $t('play') }}</span>
      </button>
    </template>
  </div>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil'
import { mapState, mapGetters } from 'vuex'
import IconPlay from '@/assets/icons/play.svg'
import IconPause from '@/assets/icons/pause.svg'

export default {
  components: {
    IconPlay,
    IconPause
  },
  data() {
    return {
      menuIsExpanded: false
    }
  },
  computed: {
    ...mapState('albums', ['isPlaying']),
    ...mapGetters({
      songs: 'albums/playableSongs'
    })
  },
  watch: {
    $route() {
      this.toggleMenu(false)
    }
  },

  methods: {
    toggleMenu(status) {
      this.menuIsExpanded = status
      this.$emit('toggleMenu', status)
    },
    pauseAudio() {
      EventBusUtil.$emit('audio-play-song', false)
    },
    playAudio() {
      EventBusUtil.$emit('audio-play-song', true)
    }
  }
}
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
