<template>
  <app-page :title="page.title" class="biography">
    <biography-intro />
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="page.content"/>
  </app-page>
</template>

<script>
import BiographyIntro from '@/components/BiographyIntro.vue'
import AppPage from '@/components/AppPage.vue'
import { biographyPageId } from '@/config/pages'
import PageQuery from '~/graphql/Page.gql'

export default {
  components: {
    BiographyIntro,
    AppPage
  },

  async asyncData({ app }) {
    const page = await app.apolloProvider.defaultClient.query({
      query: PageQuery,
      variables: {
        pageId: biographyPageId
      }
    })

    return {
      page: page.data.page
    }
  },
  data() {
    return {
      title: this.$t('biography'),
      text: ''
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
