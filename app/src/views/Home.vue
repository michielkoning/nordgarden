<template>
  <app-page>
    <transition-group name="list" tag="ul">
      <li v-for="post in list" :key="post.date">
        <h2>
          <router-link :to="post.slug">{{ post.title.rendered }}</router-link>
        </h2>
        <time :datetime="post.date | datetime">{{ $d(new Date(post.date), 'short') }}</time>
        <div v-html="post.excerpt.rendered"></div>
        <router-link :to="post.slug">Read more</router-link>
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
  filters: {
    datetime(value) {
      const date = new Date(value);
      return `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
    },
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

  margin-bottom: 3em;
  max-width: var(--container-width-xlg);
}

ul {
  @mixin list-reset;

  display: grid;
  grid-gap: 2em;
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
