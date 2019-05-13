<template>
  <div v-if="post">
    <app-page class="wrapper" :title="post.title.rendered">
      <post-date :date="post.date" />
      <div v-html="post.content.rendered"></div>
      <latest-posts />
    </app-page>
  </div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';
import AppPage from '@/components/AppPage.vue';
import LatestPosts from '@/components/LatestPosts.vue';
import PostDate from '@/components/PostDate.vue';

export default {
  components: {
    PostDate,
    AppPage,
    LatestPosts,
  },
  data() {
    return {
      post: null,
      isLoading: false,
    };
  },
  computed: {
    ...mapGetters({
      getPostBySlug: 'posts/getPostBySlug',
    }),
  },
  mounted() {
    this.getPost(this.$route.params.post);
  },
  beforeRouteUpdate(to, from, next) {
    this.getPost(to.params.post);
    next();
  },
  methods: {
    async getPostByApi(slug) {
      this.loading = true;
      try {
        const response = await axios.get('wp/v2/posts/', {
          params: {
            slug,
          },
        });
        this.post = response.data[0];
      } finally {
        this.loading = false;
      }
    },

    getPost(slug) {
      this.post = this.getPostBySlug(slug);
      if (!this.post) {
        this.getPostByApi(slug);
      }
    },
  },
};
</script>

<style lang="postcss" scoped></style>
