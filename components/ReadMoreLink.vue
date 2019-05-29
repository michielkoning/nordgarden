<template>
  <nuxt-link :to="to">
    {{ text }}
    <app-icon icon="chevron-right" width="16" height="16" />
  </nuxt-link>
</template>

<script>
import AppIcon from '@/components/AppIcon.vue'

export default {
  components: {
    AppIcon
  },
  props: {
    to: {
      type: String,
      required: true
    },
    text: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="postcss" scoped>
a {
  text-decoration: none;
  box-shadow: 0 2px 0 0 var(--color-primary);
  transition: box-shadow 0.1s ease-out;

  &:hover {
    box-shadow: 0 3px 0 0 var(--color-primary);
    svg {
      transform: translate3d(0.5em, 2px, 0);
    }
  }
}

svg {
  transition: all 0.2s ease-out;
  transform: translate3d(2px, 2px, 0);
}
</style>
