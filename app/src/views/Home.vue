<template>
  <app-page class="wrapper">
    <transition-group name="list" tag="ul">
      <li v-for="post in list" :key="post.date">
        <router-link :to="post.slug">{{ post.id }}</router-link>
        <!-- {{ post.excerpt.rendered }} -->
      </li>
    </transition-group>
    <button v-if="!hasAllPostsLoaded" @click="setPosts">Load more</button>
  </app-page>
</template>

<script>
import { mapActions, mapState, mapGetters } from 'vuex';
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    AppPage,
  },
  computed: {
    ...mapState('posts', ['list', 'isLoading']),
    ...mapGetters({
      hasAllPostsLoaded: 'posts/hasAllPostsLoaded',
    }),
  },

  mounted() {
    if (!this.list.length) this.setPosts();
  },
  methods: {
    ...mapActions({
      setPosts: 'posts/setPosts',
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

.list-enter-active,
.list-leave-active {
  transition: all 0.2s;
}

.list-enter,
.list-leave-to {
  opacity: 0;
  transform: translateY(1em);
}
</style>
