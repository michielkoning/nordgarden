<template>
  <ul class="gallery">
    <li v-for="n in 6" :key="n">
      <img :src="`/images/${n}.jpg`" alt />
    </li>
  </ul>
</template>

<style lang="postcss" scoped>
.gallery {
  @mixin list-reset;

  display: grid;
  margin: 5em 0;
  grid-gap: 1em;
  /* height: 80vh; */
  grid-template-areas:
    '. . photo-3 photo-3'
    'photo-1 photo-2 photo-3 photo-3'
    'photo-4 photo-4 photo-5 photo-6'
    'photo-4 photo-4 photo-5 .';
  grid-template-rows: repeat(4, 10em);
}

li:nth-child(1) {
  grid-area: photo-1;
}

li:nth-child(2) {
  grid-area: photo-2;
}

li:nth-child(3) {
  grid-area: photo-3;
}

li:nth-child(4) {
  grid-area: photo-4;
}

li:nth-child(5) {
  grid-area: photo-5;
}

li:nth-child(6) {
  grid-area: photo-6;
}

img {
  display: block;
  height: 100%;
  object-fit: cover;
  width: 100%;
}
</style>
