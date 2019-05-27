<template>
  <div id="app">
    <app-header />
    <router-view />
    <error-handler />
  </div>
</template>

<script>
import AppHeader from '@/components/AppHeader.vue';
import ErrorHandler from '@/components/ErrorHandler.vue';
import { mapActions } from 'vuex';

export default {
  components: {
    AppHeader,
    ErrorHandler,
  },

  mounted() {
    this.setTour();
  },
  methods: {
    ...mapActions({
      setTour: 'tour/set',
    }),
  },
};
</script>

<style scoped lang="postcss">
@import './styles/base.css';
</style>
