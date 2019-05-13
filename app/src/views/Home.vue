<template>
  <app-page>
    <latest-posts />
  </app-page>
</template>

<script>
import LatestPosts from '@/components/LatestPosts.vue';
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    LatestPosts,
    AppPage,
  },
};
</script>

<style lang="postcss" scoped>
.wrapper {
  @mixin center;

  margin-bottom: 3em;
  max-width: var(--container-width-xlg);
}
</style>
