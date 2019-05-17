<template>
  <main>
    <h1 id="content" tabindex="-1">{{ title }}</h1>
    <slot />
  </main>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: '',
    },
  },
};
</script>

<style lang="postcss" scoped>
main {
  min-height: 100vh;
  padding: var(--gutter);

  @media (--navigation-position-left) {
    margin-left: var(--width-navigation-left);
  }
}
</style>
