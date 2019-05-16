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
  padding: 0 3em;

  @media (--viewport-md) {
    margin-left: 20rem;
  }
}
</style>
