<template>
  <section class="gallery" aria-labelledby="gallery-title">
    <h1 id="gallery-title" class="sr-only">{{ $t('gallery') }}</h1>
    <div
      v-for="n in images"
      :key="n"
      class="image-wrapper"
      :class="`item-${n}`"
    >
      <img loading="lazy" :src="`/media/images/${n}.jpg`" alt />
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      images: ['2', '3', '4']
    }
  }
}
</script>

<style lang="postcss" scoped>
.gallery {
  @mixin list-reset;

  display: grid;
  margin: 2em 0 3em;
  grid-gap: 1em;
  /* height: 80vh; */
  grid-template-areas:
    'photo-3 photo-3 photo-2  '
    'photo-4 photo-4 photo-4';
  grid-template-rows: repeat(2, 1fr);

  @media (--viewport-xlg) {
    grid-template-areas: 'photo-3 photo-3 photo-2 photo-4 photo-4';
    grid-template-rows: 1fr;
  }
}

h1 {
  grid-area: title;
  align-self: end;
  margin-bottom: 0;
}

.item-1 {
  display: none;
  grid-area: photo-1;
}

.item-2 {
  grid-area: photo-2;
}

.item-3 {
  grid-area: photo-3;
}

.item-4 {
  grid-area: photo-4;
}

.item-5 {
  grid-area: photo-5;
}

.item-6 {
  grid-area: photo-6;
}

img {
  height: 40vw;
  display: block;
  object-fit: cover;
  width: 100%;

  @media (--viewport-xlg) {
    height: 20vw;
  }
}
</style>
