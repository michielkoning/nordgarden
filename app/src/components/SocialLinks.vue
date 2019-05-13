<template>
  <nav aria-labelledby="social-links-title">
    <h2 class="sr-only">{{ $t('socialMediaLinks') }}</h2>
    <ul class="social-links">
      <li>
        <a href="#">
          <app-icon icon="amazon" :title="`${'viewNordgardenOn'} amazon`" />
        </a>
      </li>
      <li>
        <a href="#">
          <app-icon icon="spotify" :title="`${'viewNordgardenOn'} spotify`" />
        </a>
      </li>
      <li>
        <a href="#">
          <app-icon icon="youtube" :title="`${'viewNordgardenOn'} youtube`" />
        </a>
      </li>
      <li>
        <a href="#">
          <app-icon icon="last.fm" :title="`${'viewNordgardenOn'} last.fm`" />
        </a>
      </li>
      <li>
        <a href="#">
          <app-icon icon="facebook" :title="`${'viewNordgardenOn'} facebook`" />
        </a>
      </li>
      <li>
        <a href="#">
          <app-icon icon="twitter" :title="`${'viewNordgardenOn'} twitter`" />
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
import AppIcon from '@/components/AppIcon.vue';

export default {
  components: {
    AppIcon,
  },
};
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;

  display: flex;
}
</style>
