<template>
  <app-loader v-if="isLoading" />
  <app-page v-else class="biography">
    <h1>{{ biography.title.rendered }}</h1>
    <div class="text" v-html="biography.content.rendered" />
  </app-page>
</template>

<script>
import { mapActions, mapState } from 'vuex';

import AppPage from '@/components/AppPage.vue';
import AppLoader from '@/components/AppLoader.vue';

export default {
  components: {
    AppPage,
    AppLoader,
  },
  computed: {
    ...mapState('pages', ['biography']),
  },

  mounted() {
    if (!this.biography) this.setPage('biography');
  },
  methods: {
    ...mapActions({
      setPage: 'pages/setPage',
    }),
  },
};
</script>

<style lang="postcss" scoped>
.text {
  max-width: var(--container-width-sm);
}
</style>
