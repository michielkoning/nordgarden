<template>
  <picture>
    <source
      type="image/webp"
      :srcset="'/img/' + src + '.webp, /img/' + src + '@2x.webp 2x'"
    />
    <source :srcset="'/img/' + src + '.png, /img/' + src + '@2x.png 2x'" />
    <img :src="'/img/' + src + '.png'" :width="width" :height="height" alt />
  </picture>
</template>

<script>
export default {
  props: {
    src: {
      type: String,
      required: true
    },
    width: {
      type: Number,
      default: 0
    },
    height: {
      type: Number,
      default: 0
    }
  }
}
</script>

<style scoped lang="postcss">
picture,
img {
  display: block;
  width: 100%;
}
</style>
