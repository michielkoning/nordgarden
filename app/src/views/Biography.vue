<template>
  <app-page v-if="biography" class="biography">
    <h1>{{ biography.title.rendered }}</h1>
    <div class="text" v-html="biography.content.rendered" />
  </app-page>
</template>

<script>
import { mapActions, mapState } from 'vuex';

import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    AppPage,
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
  columns: 100px 3;
  column-gap: var(--gutter);
}
</style>
