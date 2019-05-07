<template>
  <div id="app">
    <audio-player />
    <app-menu />
    <router-view />
  </div>
</template>

<script>
import AudioPlayer from '@/components/AudioPlayer.vue';
import AppMenu from '@/components/AppMenu.vue';

export default {
  components: {
    AudioPlayer,
    AppMenu,
  },
};
</script>

<style>
@import './styles/base.css';
</style>
