<template>
  <picture>
    <source
      type="image/webp"
      :srcset="
        require(`~/assets/images/albums/${image}.webp`) +
          ' 1x, ' +
          require(`~/assets/images/albums/${image}@2x.webp`) +
          ' 2x'
      "
    />
    <source
      type="image/jpg"
      :srcset="
        require(`~/assets/images/albums/${image}.${extension}`) +
          ' 1x, ' +
          require(`~/assets/images/albums/${image}@2x.${extension}`) +
          ' 2x'
      "
    />

    <img
      :src="require(`~/assets/images/albums/${image}.${extension}`)"
      v-bind="$attrs"
      :width="width"
      :height="height"
      loading="lazy"
      alt
    />
  </picture>
</template>

<script>
export default {
  props: {
    image: {
      type: String,
      required: true
    },
    extension: {
      type: String,
      default: 'jpg'
    },
    width: {
      type: Number,
      required: true
    },
    height: {
      type: Number,
      required: true
    }
  }
}
</script>
