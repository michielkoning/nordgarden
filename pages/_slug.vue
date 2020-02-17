<template>
  <app-page :title="post.title" class="post">
    <post-date :date="post.date" />
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="post.content" />
    <latest-posts />
  </app-page>
</template>

<script>
import AppPage from '~/components/Layout/AppPage.vue'
import LatestPosts from '~/components/Posts/LatestPosts.vue'
import PostDate from '~/components/Shared/AppDate.vue'
import getSeoMetaData from '~/helpers/seo'
import PostQuery from '~/graphql/Post.gql'

export default {
  components: {
    AppPage,
    PostDate,
    LatestPosts
  },

  async asyncData({ app, params }) {
    const post = await app.apolloProvider.defaultClient.query({
      query: PostQuery,
      variables: {
        uri: params.slug
      }
    })

    return {
      post: post.data.post
    }
  },

  head() {
    const { title, metaDesc } = this.post.seo
    const { slug } = this.post
    return getSeoMetaData(title, metaDesc, slug)
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
