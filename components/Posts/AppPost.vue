<template>
  <li @mousedown.left="mouseDown" @mouseup.left="mouseUp">
    <div class="text">
      <!-- eslint-disable-next-line -->
       <h2><router-link :to="post.slug" v-html="post.title" /></h2>
      <post-date :date="post.date" />
    </div>
    <img
      src="https://api.nordgarden.info/wp-content/uploads/2018/11/Cover_Nordgarden_Du-vel-komme-hjem-til-jul_1400x1400-300x300.jpg"
      alt=""
    />
  </li>
</template>

<script>
import PostDate from '~/components/Shared/AppDate.vue'

export default {
  components: {
    PostDate,
  },
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      down: null,
    }
  },
  methods: {
    mouseUp() {
      const up = +new Date()
      if (up - this.down < 200) {
        this.goToPost()
      }
    },
    mouseDown() {
      this.down = +new Date()
    },
    goToPost() {
      this.$router.push(this.post.slug)
    },
  },
}
</script>

<style lang="postcss" scoped>
li {
  border-bottom: 2px dashed var(--color-white);
  cursor: pointer;
  position: relative;

  &:hover .read-more,
  &:focus-within .read-more {
    box-shadow: 0 3px 0 0 var(--color-primary);

    & svg {
      margin-left: var(--spacing-xxs);
    }
  }
}

h2 {
  margin-bottom: 0;
}

a {
  @mixin link-reset;
}

time {
  order: -1;
  font-size: var(--font-size-sm);
}

.text {
  display: flex;
  flex-direction: column;
  position: absolute;
  padding: 2em var(--spacing-xs) var(--spacing-xs);
  bottom: 0;
  left: 0;
  right: 0;

  /* prettier-ignore */
  background-image:
    linear-gradient(
      rgba(0, 0, 0, 0) 0%,
      rgba(0, 0, 0, 0.7) 20%
    );
}

img {
  display: block;
  height: 20em;
  object-fit: cover;
  margin-bottom: var(--spacing-xs);
}

.text .link-wrapper {
  margin-top: auto;
}
</style>
