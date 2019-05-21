<template>
  <app-loader v-if="isLoading" />
  <div v-else>
    <app-page v-if="biography" class="biography" :title="biography.title.rendered">
      <div class="quote">
        <blockquote cite="Stein Ostboe, VG, Norway">
          “The closest a new Norwegian singer/songwriter has come the timeless qualities of Ryan
          Adams”
        </blockquote>
        <cite>Stein Ostboe, VG, Norway</cite>
      </div>
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
  column-count: 2;
  column-gap: var(--gutter);
}

.quote {
  margin: 0 0 1em;
}

blockquote {
  margin: 0 0 0.25em;
  font-weight: var(--font-weight-bold);
  font-size: 1.5em;
  line-height: 1.2;
}

cite {
  display: block;

  &::before {
    content: '—';
    margin-left: 1em;
  }
}
</style>
