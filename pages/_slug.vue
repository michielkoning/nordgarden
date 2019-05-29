<template>
  <app-page class="biography" :title="title">
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="text"/>
    <latest-posts />
  </app-page>
</template>

<script>
import AppPage from '@/components/AppPage.vue'
import axios from 'axios'
import LatestPosts from '@/components/LatestPosts.vue'

export default {
  components: {
    AppPage,
    LatestPosts
  },
  meta: {
    step: 0
  },
  data() {
    return {
      title: '',
      text: ''
    }
  },

  async asyncData({ params }) {
    const response = await axios.get(
      'http://localhost:9030/wp-json/wp/v2/posts/',
      {
        params: {
          slug: params.slug
        }
      }
    )
    const post = response.data[0]

    return {
      title: post.title.rendered,
      text: post.content.rendered
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
</style>
