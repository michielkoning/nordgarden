<template>
  <app-page :title="title" class="biography">
    <biography-intro />
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="text"/>
  </app-page>
</template>

<script>
import BiographyIntro from '@/components/BiographyIntro.vue'
import AppPage from '@/components/AppPage.vue'
import { biographyPageId } from '@/config/pages'
import axios from '~/plugins/axios'

export default {
  components: {
    BiographyIntro,
    AppPage
  },

  async asyncData({ params }) {
    const response = await axios.get(`wp/v2/pages/${biographyPageId}`)

    return { text: response.data.content.rendered }
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
