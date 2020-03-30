<template>
  <lazy-loading-image
    v-if="image"
    :src="image.archive"
    :alt="image.altText"
    :srcset="`${image.archive} 1x, ${image.archive2x} 2x`"
    class="image"
  />
</template>

<script>
import LazyLoadingImage from '~/components/Shared/Images/LazyLoadingImage.vue'

export default {
  components: {
    LazyLoadingImage,
  },

  props: {
    image: {
      type: Object,
      default: () => {},
    },
  },
}
</script>
