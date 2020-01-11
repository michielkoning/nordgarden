<template>
  <main :class="$style.main">
    <div :class="$style.content">
      <!-- eslint-disable-next-line -->
      <h1 id="content" tabindex="-1" v-html="title" />
      <slot />
    </div>
    <img
      :src="require('~/assets/images/promo.png')"
      :class="$style.promo"
      loading="lazy"
      alt
    />
  </main>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: ''
    }
  }
}
</script>

<style lang="postcss" module>
.main {
  display: flex;
  min-height: 100vh;
  padding: 5em var(--gutter) 0;
  flex-direction: column;

  @media (--navigation-position-left) {
    margin-left: var(--width-navigation-left);
    padding-top: var(--gutter);
  }
}

.content {
  flex: 1 1 auto;
}

.promo {
  display: block;
  margin: 5em auto 0;
}
</style>
