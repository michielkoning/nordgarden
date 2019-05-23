<template>
  <app-loader v-if="isLoading" />
  <div v-else>
    <app-page v-if="biography" class="biography" :title="biography.title.rendered">
      <biography-intro />
      <div class="text" v-html="biography.content.rendered" />
    </app-page>
  </div>
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
