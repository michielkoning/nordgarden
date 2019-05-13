<template>
  <app-loader v-if="isLoading" />
  <div v-else>
    <app-page v-if="biography" class="biography" :title="biography.title.rendered">
      <div class="text" v-html="biography.content.rendered" />
    </app-page>
  </div>
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
    ...mapState('pages', ['biography', 'isLoading']),
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
