<template>
  <app-page :title="title" class="post">
    <post-date :date="date" />
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="text" />
    <latest-posts />
  </app-page>
</template>

<script>
import AppPage from '@/components/AppPage.vue'
import axios from '~/plugins/axios'
import LatestPosts from '@/components/LatestPosts.vue'
import PostDate from '@/components/PostDate.vue'

export default {
  components: {
    AppPage,
    PostDate,
    LatestPosts
  },

  async asyncData({ params }) {
    const response = await axios.get(`wp/v2/posts/`, {
      params: {
        slug: params.slug
      }
    })
    const post = response.data[0]

    return {
      title: post.title.rendered,
      text: post.content.rendered,
      date: post.date
    }
  },
  data() {
    return {
      title: '',
      text: '',
      date: ''
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
  font-size: var(--font-size-sm);
  color: var(--color-gray);
  margin-bottom: var(--spacing-m);
  display: block;
}

>>> h1 {
  margin-bottom: 0.25rem;
}
</style>
