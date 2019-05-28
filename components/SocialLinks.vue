<template>
  <nav aria-labelledby="social-links-title">
    <h2 id="social-links-title" class="sr-only">
      {{ $t('socialMediaLinks') }}
    </h2>
    <ul class="social-links">
      <li>
        <a href="#" rel="noopener" target="_blank">
          <app-icon
            icon="spotify"
            width="32"
            height="32"
            :title="`${'viewNordgardenOn'} spotify`"
          />
        </a>
      </li>
      <li>
        <a href="#" rel="noopener" target="_blank">
          <app-icon
            icon="apple"
            width="32"
            height="32"
            :title="`${'viewNordgardenOn'} Apple`"
          />
        </a>
      </li>
      <li>
        <a href="#" rel="noopener" target="_blank">
          <app-icon
            icon="youtube"
            width="32"
            height="32"
            :title="`${'viewNordgardenOn'} youtube`"
          />
        </a>
      </li>
      <li>
        <a href="#" rel="noopener" target="_blank">
          <app-icon
            icon="last.fm"
            width="32"
            height="32"
            :title="`${'viewNordgardenOn'} last.fm`"
          />
        </a>
      </li>
      <li>
        <a href="#" rel="noopener" target="_blank">
          <app-icon
            icon="facebook"
            width="32"
            height="32"
            :title="`${'viewNordgardenOn'} facebook`"
          />
        </a>
      </li>
      <li>
        <a href="#" rel="noopener" target="_blank">
          <app-icon
            icon="twitter"
            width="32"
            height="32"
            :title="`${'viewNordgardenOn'} twitter`"
          />
        </a>
      </li>
      <li>
        <a href="#" rel="noopener" target="_blank">
          <app-icon
            icon="linkedin"
            width="32"
            height="32"
            :title="`${'viewNordgardenOn'} LinkedIn`"
          />
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
import AppIcon from '@/components/AppIcon.vue'

export default {
  components: {
    AppIcon
  }
}
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;

  justify-content: space-between;
  display: flex;
  margin-bottom: 1em;
}
</style>
