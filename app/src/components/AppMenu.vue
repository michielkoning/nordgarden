<template>
  <nav aria-labelledby="menu-title">
    <h2 id="menu-title" class="sr-only" tabindex="-1">{{ $t('mainNavigation') }}</h2>
    <ul>
      <li>
        <router-link to="/">{{ $t('home') }}</router-link>
      </li>
      <li>
        <router-link to="/tour">
          {{ $t('tour') }}
          <app-badge :amount="list.length" />
        </router-link>
      </li>
      <li>
        <router-link to="/albums">{{ $t('albums') }}</router-link>
      </li>
      <li>
        <router-link to="/videos">{{ $t('videos') }}</router-link>
      </li>
      <li>
        <router-link to="/biography">{{ $t('biography') }}</router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
import AppBadge from '@/components/AppBadge.vue';
import { mapState } from 'vuex';

export default {
  components: {
    AppBadge,
  },
  computed: {
    ...mapState('tour', ['list']),
  },
};
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;

  margin-bottom: 1em;
}

a {
  align-items: center;
  display: flex;
  position: relative;
}
</style>
