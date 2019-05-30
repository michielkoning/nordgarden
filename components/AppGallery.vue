<template>
  <div class="gallery">
    <h1 class="sr-only">Gallery</h1>
    <div v-for="n in 4" :key="n" class="image-wrapper" :class="`item-${n}`">
      <img :src="`/images/${n}.jpg`" alt />
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.gallery {
  @mixin list-reset;

  display: grid;
  margin: 2em 0 5em;
  grid-gap: 1em;
  /* height: 80vh; */
  grid-template-areas:
    'photo-3 photo-3 photo-3 photo-2  '
    'photo-3 photo-3 photo-3 photo-2 '
    'photo-4 photo-4 photo-4 photo-4'
    'photo-4 photo-4 photo-4 photo-4';
  grid-template-rows: repeat(4, 10em);
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
  display: block;
  height: 100%;
  object-fit: cover;
  width: 100%;
}
</style>
