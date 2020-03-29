<template>
  <app-page :title="title" class="biography">
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="text"/>
  </app-page>
</template>

<script>
import { contactPageId } from '@/config/pages'
import AppPage from '~/components/Layout/AppPage.vue'
import axios from '~/plugins/axios'

export default {
  components: {
    AppPage,
  },

  async asyncData({ params }) {
    const response = await axios.get(`wp/v2/pages/${contactPageId}`)

    return { text: response.data.content.rendered }
  },
  data() {
    return {
      title: this.$t('biography'),
      text: '',
    }
  },
  head() {
    return {
      title: this.title,
    }
  },
}
</script>

<style lang="postcss" scoped>
.text {
  max-width: 60ch;
}
</style>
