<template>
  <div class="news-list">
    <h2>{{ $t('latestPosts') }}</h2>
    <transition-group name="list" tag="ul">
      <li v-for="post in list" :key="post.date">
        <h2>
          <router-link :to="post.slug">{{ post.title.rendered }}</router-link>
        </h2>
        <post-date :date="post.date" />
        <div v-html="post.excerpt.rendered"></div>
        <router-link :to="post.slug">{{ $t('readMore') }}</router-link>
      </li>
    </transition-group>
    <app-loader v-if="isLoading" />
    <button v-else-if="!hasAllPostsLoaded" @click="setPosts">{{ $t('loadMore') }}</button>
  </div>
</template>

<script>
import { mapActions, mapState, mapGetters } from 'vuex';
import PostDate from '@/components/PostDate.vue';
import AppLoader from '@/components/AppLoader.vue';

export default {
  components: {
    PostDate,
    AppLoader,
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
.news-list {
  margin-bottom: 5em;
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
