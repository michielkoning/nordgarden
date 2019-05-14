<template>
  <header>
    <h1>
      <router-link to="/">Nordgarden</router-link>
    </h1>
    <mobile-navigation @toggleMenu="toggleMenu"/>
    <main-navigation/>
    <audio-player/>
    <social-links/>
  </header>
</template>

<script>
import AudioPlayer from '@/components/AudioPlayer.vue';
import MainNavigation from '@/components/MainNavigation.vue';
import SocialLinks from '@/components/SocialLinks.vue';
import MobileNavigation from '@/components/MobileNavigation.vue';

export default {
  components: {
    AudioPlayer,
    SocialLinks,
    MainNavigation,
    MobileNavigation,
  },
  methods: {
    toggleMenu(status) {
      console.log(status);
    },
  },
};
</script>

<style lang="postcss" scoped>
header {
  position: fixed;
  left: 0;
  top: 3em;
  bottom: 0;
  width: 20em;
  background: rgba(255, 255, 255, 0.5);
  padding: var(--gutter);
}
</style>
