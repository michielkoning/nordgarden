<template>
  <div class="wrapper">
    <ul>
      <li v-for="post in list" :key="post.date">
        <router-link :to="post.slug">{{ post.title.rendered }}</router-link>
        {{ post.excerpt.rendered }}
      </li>
    </ul>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';

export default {
  computed: {
    ...mapState('posts', ['list']),
  },

  mounted() {
    if (!this.list.length) this.setPosts();
  },
  methods: {
    ...mapActions({
      setPosts: 'posts/set',
    }),
  },
};
</script>

<style lang="postcss" scoped>
.wrapper {
  @mixin center;
  max-width: var(--container-width-xlg);
}

ul {
  @mixin list-reset;

  display: grid;
  grid-gap: var(--gutter);
  grid-template-columns: repeat(auto-fit, minmax(15em, 1fr));
}
</style>
