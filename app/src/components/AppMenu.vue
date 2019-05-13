<template>
  <nav>
    <h2 id="menu" class="sr-only" tabindex="-1">Hoofdnavigatie</h2>
    <router-link to="/">{{ $t('home') }}</router-link>
    <router-link to="/tour">
      {{ $t('tour') }}
      <app-badge :amount="list.length" />
    </router-link>
    <router-link to="/albums">{{ $t('albums') }}</router-link>
    <router-link to="/videos">{{ $t('videos') }}</router-link>
    <router-link to="/biography">{{ $t('biography') }}</router-link>
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
a {
  margin: 0 1em;
  align-items: center;
  display: flex;
  position: relative;
}
</style>
