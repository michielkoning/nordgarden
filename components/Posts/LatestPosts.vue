<template>
  <div>
    <transition-group v-if="posts" name="list" tag="ul">
      <app-post
        v-for="post in posts.edges"
        :key="post.node.id"
        :post="post.node"
      />
    </transition-group>
    <app-loader v-if="$apollo.queries.posts.loading" />
    <div v-else-if="posts.pageInfo.hasNextPage" class="button-wrapper">
      <button class="btn" @click="showMore">
        {{ $t('loadMore') }}
      </button>
    </div>
  </div>
</template>

<script>
import AppPost from '~/components/Posts/AppPost.vue'
import AppLoader from '~/components/Shared/AppLoader.vue'
import PostsQuery from '~/graphql/Posts.gql'

export default {
  components: {
    AppPost,
    AppLoader,
  },
  apollo: {
    posts: {
      query: PostsQuery,
      variables() {
        return {
          first: 12,
          notIn: this.notIn,
        }
      },
    },
  },
  props: {
    notIn: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      posts: null,
    }
  },
  methods: {
    showMore() {
      // Fetch more data and transform the original result
      this.$apollo.queries.posts.fetchMore({
        // New variables
        variables: {
          after: this.posts.pageInfo.endCursor,
        },
        // Transform the previous result with new data
        updateQuery: (previousResult, { fetchMoreResult }) => {
          const newPosts = fetchMoreResult.posts
          this.showMoreButton = fetchMoreResult.posts.pageInfo.hasNextPage

          return {
            posts: {
              __typename: previousResult.posts.__typename,
              pageInfo: newPosts.pageInfo,
              // Merging the tag list
              edges: [...previousResult.posts.edges, ...newPosts.edges],
            },
          }
        },
      })
    },
  },
}
</script>

<style lang="postcss" scoped>
.news-list {
  margin-bottom: 5em;
}

ul {
  @mixin list-reset;

  display: grid;
  grid-gap: var(--spacing-l);
  grid-template-columns: repeat(auto-fit, minmax(15em, 1fr));
}

.list-enter-active,
.list-leave-active {
  transition: all 0.2s;
}

.list-enter,
.list-leave-to {
  opacity: 0;
  transform: translateY(var(--spacing-m));
}

.button-wrapper {
  display: flex;
  justify-content: center;
}

.btn {
  width: 100%;
}
</style>
