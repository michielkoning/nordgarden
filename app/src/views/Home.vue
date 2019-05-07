<template>
  <div class="posts">
    <ul>
      <li v-for="post in posts" :key="post.date">
        <router-link :to="post.slug">{{ post.title.rendered }}</router-link>
      </li>
    </ul>
    {{ posts }}
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      posts: [],
      isLoading: false,
    };
  },
  mounted() {
    this.getPosts();
  },
  methods: {
    async getPosts() {
      this.loading = true;
      try {
        const response = await axios.get('wp/v2/posts');
        this.posts = response.data;
      } catch (error) {
        window.console.error(error);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
