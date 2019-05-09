<template>
  <div class="wrapper">{{ post }}</div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      post: null,
      isLoading: false,
      slug: this.$route.params.post,
    };
  },
  computed: {
    ...mapGetters({
      getBySlug: 'posts/getBySlug',
    }),
  },
  mounted() {
    this.getPost();
  },
  methods: {
    async getPostByApi() {
      this.loading = true;
      try {
        const response = await axios.get('wp/v2/posts/', {
          params: {
            slug: this.slug,
          },
        });
        this.post = response.data;
      } finally {
        this.loading = false;
      }
    },

    getPost() {
      this.post = this.getBySlug(this.slug);
      if (!this.post) {
        this.getPostByApi();
      }
    },
  },
};
</script>

<style lang="postcss" scoped>
.wrapper {
  display: none;
}
</style>
