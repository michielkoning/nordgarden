<template>
  <div id="app">
    <skip-links />
    <error-handler />
    <app-header />
    <router-view />
  </div>
</template>

<script>
import AppHeader from '@/components/AppHeader.vue';
import ErrorHandler from '@/components/ErrorHandler.vue';
import SkipLinks from '@/components/SkipLinks.vue';
import { mapActions } from 'vuex';

export default {
  components: {
    AppHeader,
    ErrorHandler,
    SkipLinks,
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
