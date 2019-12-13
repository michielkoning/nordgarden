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
import axios from '~/plugins/axios'

export default {
  components: {
    BiographyIntro,
    AppPage
  },
  meta: {
    step: 4
  },
  data() {
    return {
      title: this.$t('biography'),
      text: ''
    }
  },

  async asyncData({ params }) {
    const response = await axios.get(`wp/v2/pages/`, {
      params: {
        slug: 'biography'
      }
    })

    return { text: response.data[0].content.rendered }
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
