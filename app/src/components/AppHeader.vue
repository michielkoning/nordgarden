<template>
  <header>
    <app-menu />
    <audio-player />
    <app-icon icon="amazon" />
  </header>
</template>

<script>
import AudioPlayer from '@/components/AudioPlayer.vue';
import AppMenu from '@/components/AppMenu.vue';
import AppIcon from '@/components/AppIcon.vue';

export default {
  components: {
    AudioPlayer,
    AppIcon,
    AppMenu,
  },
};
</script>

<style lang="postcss" scoped>
header {
  position: fixed;
  left: 0;
  top: 0;
  bottom: 0;
  width: 20em;
  background: rgba(255, 255, 255, 0.5);
}
</style>
