<template>
  <nav>
    <router-link to="/">Home</router-link>
    <router-link to="/tour">
      Tour
      <span v-if="list.length">({{ list.length }})</span>
    </router-link>
    <router-link to="/albums">Albums</router-link>
    <router-link to="/videos">Videos</router-link>
    <router-link to="/biography">Biography</router-link>
    <router-link to="/contact">Contact</router-link>
    <audio-player />
  </nav>
</template>

<script>
import AudioPlayer from '@/components/AudioPlayer.vue';
import { mapState } from 'vuex';

export default {
  components: {
    AudioPlayer,
  },
  computed: {
    ...mapState('tour', ['list', 'isLoading']),
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
  background: rgba(255, 255, 255, 0.5);
}

a {
  margin: 0 1em;
  display: block;
}
</style>
