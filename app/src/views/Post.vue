<template>
  <div class="post">{{ post }}</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      post: null,
      isLoading: false,
    };
  },
  mounted() {
    this.getPost();
  },
  methods: {
    async getPost() {
      this.loading = true;
      try {
        const response = await axios.get('wp/v2/posts/', {
          params: {
            slug: this.$route.params.post,
          },
        });
        this.post = response.data;
      } catch (error) {
        window.console.error(error);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
