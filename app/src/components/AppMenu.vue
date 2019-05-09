<template>
  <nav>
    <router-link to="/">Home</router-link>
    <router-link to="/tour">Tour</router-link>
    <router-link to="/albums">Albums</router-link>
    <router-link to="/videos">Videos</router-link>
    <router-link to="/biography">Biography</router-link>
    <router-link to="/contact">Contact</router-link>
    <audio-player />
  </nav>
</template>

<script>
import AudioPlayer from '@/components/AudioPlayer.vue';

export default {
  components: {
    AudioPlayer,
  },
};
</script>

<style lang="postcss" scoped>
nav {
  position: fixed;
  left: 0;
  top: 0;
  bottom: 0;
  width: 20em;
}

a {
  margin: 0 1em;
  display: block;
}
</style>
