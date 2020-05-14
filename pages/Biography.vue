<template>
  <app-page :title="page.title" class="biography">
    <biography-intro />
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="page.content"/>
  </app-page>
</template>

<script>
import BiographyIntro from '~/components/Biography/BiographyIntro.vue'
import AppPage from '~/components/Layout/AppPage.vue'
import { biographyPageId } from '~/config/pages'
import getSeoMetaData from '~/helpers/seo'
import PageQuery from '~/graphql/Page.gql'

export default {
  components: {
    BiographyIntro,
    AppPage,
  },

  async asyncData({ app }) {
    const page = await app.apolloProvider.defaultClient.query({
      query: PageQuery,
      variables: {
        pageId: biographyPageId,
      },
    })

    return {
      page: page.data.page,
    }
  },
  head() {
    const { title, metaDesc } = this.page.seo
    const slug = 'biography'
    return getSeoMetaData(title, metaDesc, slug)
  },
}
</script>

<style lang="postcss" scoped>
.text {
  @mixin text-overflow;

  max-width: 60ch;
}
</style>
