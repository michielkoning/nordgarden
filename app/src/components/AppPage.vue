<template>
  <main>
    <h1>{{ title }}</h1>
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
  margin-left: 20rem;
  padding: 0 3em;
}
</style>
