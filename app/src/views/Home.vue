<template>
  <div class="posts">
    <ul>
      <li v-for="post in list" :key="post.date">
        <router-link :to="post.slug">{{ post.title.rendered }}</router-link>
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
