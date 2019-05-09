<template>
  <div id="app">
    <!-- <error-handler />
    <audio-player />
    <app-menu />-->
    <router-view />
  </div>
</template>

<script>
import AudioPlayer from '@/components/AudioPlayer.vue';
import AppMenu from '@/components/AppMenu.vue';
import ErrorHandler from '@/components/ErrorHandler.vue';

export default {
  components: {
    AudioPlayer,
    AppMenu,
    ErrorHandler,
  },
};
</script>

<style>
@import './styles/base.css';
</style>
