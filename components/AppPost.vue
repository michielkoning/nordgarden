<template>
  <li>
    <h2>{{ post.title.rendered }}</h2>
    <post-date :date="post.date" />

    {{ post.excerpt.rendered }}
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
}

.link-wrapper {
  margin-top: auto;
}
</style>
