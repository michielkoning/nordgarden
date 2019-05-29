<template>
  <app-page class="biography" :title="title">
    <biography-intro />
    <app-loader v-if="isLoading" />
    <template v-else>
      <div v-if="biography" class="text">{{ post.excerpt.rendered }}</div>
    </template>
  </app-page>
</template>

<script>
import { mapActions, mapState } from 'vuex'
import AppLoader from '@/components/AppLoader.vue'
import BiographyIntro from '@/components/BiographyIntro.vue'
import AppPage from '@/components/AppPage.vue'

export default {
  components: {
    AppLoader,
    BiographyIntro,
    AppPage
  },
  meta: {
    step: 4
  },
  data() {
    return {
      title: this.$t('biography')
    }
  },
  computed: {
    ...mapState('pages', ['biography', 'isLoading'])
  },

  mounted() {
    if (!this.biography) this.setPage('biography')
  },
  methods: {
    ...mapActions({
      setPage: 'pages/setPage'
    })
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
