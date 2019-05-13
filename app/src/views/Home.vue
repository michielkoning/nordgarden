<template>
  <app-page>
    <h1>News</h1>
    <news-list />
  </app-page>
</template>

<script>
import NewsList from '@/components/NewsList.vue';
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    NewsList,
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
