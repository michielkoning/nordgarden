<template>
  <nuxt-link :to="to">
    {{ text }}
    <icon-chevron-right aria-hidden="true" width="16" height="16" />
  </nuxt-link>
</template>

<script>
import IconChevronRight from '@/assets/icons/chevron-right.svg'

export default {
  components: {
    IconChevronRight
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
  &:hover svg {
    margin-left: 0.25em;
  }
}

svg {
  transition: margin 0.2s ease-out;
  transform: translate3d(2px, 2px, 0);
}
</style>
