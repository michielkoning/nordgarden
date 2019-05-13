<template>
  <header>
    <h1>
      <router-link to="/">Nordgarden</router-link>
    </h1>
    <app-menu/>
    <audio-player/>
    <social-links/>
  </header>
</template>

<script>
import AudioPlayer from '@/components/AudioPlayer.vue';
import AppMenu from '@/components/AppMenu.vue';
import SocialLinks from '@/components/SocialLinks.vue';

export default {
  components: {
    AudioPlayer,
    SocialLinks,
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
