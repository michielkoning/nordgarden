<template>
  <app-page class="wrapper" :title="post.title.rendered">
    <div v-html="post.content.rendered"></div>
  </app-page>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    AppPage,
  },
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

<style lang="postcss" scoped></style>
