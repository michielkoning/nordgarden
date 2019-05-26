<template>
  <app-page class="biography" :title="$t('biography')">
    <biography-intro />
    <app-loader v-if="isLoading" />
    <template v-else>
      <div v-if="biography" class="text" v-html="biography.content.rendered" />
    </template>
  </app-page>
</template>

<script>
import { mapActions, mapState } from 'vuex';

import AppPage from '@/components/AppPage.vue';
import AppLoader from '@/components/AppLoader.vue';
import BiographyIntro from '@/components/BiographyIntro.vue';

export default {
  components: {
    AppPage,
    AppLoader,
    BiographyIntro,
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
  max-width: 60ch;
}
</style>
