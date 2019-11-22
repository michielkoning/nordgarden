<template>
  <nuxt-link :to="to" class="read-more">
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
      default: '#'
    },
    text: {
      type: String,
      required: true
    }
  }
}
</script>
