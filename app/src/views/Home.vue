<template>
  <app-page>
    <posts-list />
  </app-page>
</template>

<script>
import PostsList from '@/components/PostsList.vue';
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    PostsList,
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
