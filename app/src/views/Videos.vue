<template>
  <app-page class="content" title="Videos">
    <ul>
      <li v-for="video in videos" :key="video">
        <img :src="`https://img.youtube.com/vi/${video}/hqdefault.jpg`" alt />
      </li>
    </ul>
  </app-page>
</template>

<script>
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    AppPage,
  },
  data() {
    return {
      videos: [
        'bH67wt1CHv8',
        'JRwpPplPqmM',
        '3K-f6RVtKwA',
        'phujbtP9J_Y',
        '7qO4Lu5rxew',
        'Rc-fLsWAe_A',
        '83OIrw0AjgY',
        'RA2dLa5ZAVY',
        'ioYwLp2PKBY',
        'PBMpzxa-SJA',
        '_SnVGrgAHmg',
        '986m8vY9DVo',
      ],
    };
  },
};
</script>

<style lang="postcss" scoped>
.wrapper2 {
  @mixin center;
}

ul {
  @mixin list-reset;

  display: grid;
  grid-gap: var(--gutter);
  grid-template-columns: repeat(auto-fit, minmax(15em, 1fr));
}
</style>
