<template>
  <app-loader v-if="isLoading" />
  <app-page v-else-if="post" class="post" :title="title">
    <post-date :date="post.date" />
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="post.content.rendered"/>
    <latest-posts />
  </app-page>
</template>

<script>
import AppPage from '@/components/AppPage.vue'
import axios from '~/plugins/axios'
import LatestPosts from '@/components/LatestPosts.vue'
import PostDate from '@/components/PostDate.vue'
import AppLoader from '@/components/AppLoader.vue'
import { mapGetters } from 'vuex'

export default {
  components: {
    AppLoader,
    AppPage,
    PostDate,
    LatestPosts
  },
  meta: {
    step: 0
  },
  data() {
    return {
      isLoading: false,
      post: '',
      title: ''
    }
  },

  computed: {
    ...mapGetters({
      getPostBySlug: 'posts/getPostBySlug'
    })
  },

  mounted() {
    this.getPost(this.$route.params.slug)
  },
  methods: {
    async getPostByApi(slug) {
      this.isLoading = true
      try {
        const response = await axios.get(`wp/v2/posts/`, {
          params: {
            slug
          }
        })
        const post = response.data[0]

        this.title = post.title.rendered
        this.post = post
      } finally {
        this.isLoading = false
      }
    },
    getPost(slug) {
      this.post = this.getPostBySlug(slug)

      if (this.post) {
        this.title = this.post.title.rendered
      } else {
        this.getPostByApi(slug)
      }
    }
  },
  head() {
    return {
      title: this.title
    }
  }
}
</script>

<style lang="postcss" scoped>
.text {
  max-width: 60ch;
}

time {
  font-size: 0.9em;
  color: var(--color-gray);
  margin-bottom: 1em;
  display: block;
}

>>> h1 {
  margin-bottom: 0.25rem;
}
</style>
