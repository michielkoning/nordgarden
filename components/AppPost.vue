<template>
  <li>
    <!-- eslint-disable-next-line -->
    <h2 v-html="post.title.rendered"/>
    <post-date :date="post.date" />
    <!-- eslint-disable-next-line -->
    <div class="text" v-html="post.excerpt.rendered"/>
    <div class="link-wrapper">
      <read-more-link :to="post.slug" :text="$t('readMore')" />
    </div>
  </li>
</template>

<script>
import PostDate from '@/components/PostDate.vue'
import ReadMoreLink from '@/components/ReadMoreLink.vue'

export default {
  components: {
    PostDate,
    ReadMoreLink
  },
  props: {
    post: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="postcss" scoped>
li {
  display: flex;
  flex-direction: column;
  padding-bottom: 1em;
  border-bottom: 2px dashed var(--color-white);
}

time {
  order: -1;
  font-size: 0.9em;
  color: var(--color-gray);
}

.link-wrapper {
  margin-top: auto;
}
</style>
