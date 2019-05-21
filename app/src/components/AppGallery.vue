<template>
  <ul class="gallery">
    <li v-for="n in 7" :key="n">
      <img :src="`/img/${n}.jpg`" alt>
    </li>
  </ul>
</template>

<style lang="postcss" scoped>
.gallery {
  @mixin list-reset;

  display: grid;
  margin: 0 -2em 2em -22em;
  /* height: 80vh; */
  grid-template-columns: 20em repeat(3, 1fr);
  grid-template-rows: repeat(3, 20vh);
}

li:nth-child(3) {
  grid-column: span 2;
  grid-row: span 2;
}

img {
  display: block;
  height: 100%;
  object-fit: cover;
  width: 100%;
}
</style>
