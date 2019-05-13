<template>
  <nav>
    <router-link to="/">{{ $t('Home') }}</router-link>
    <router-link to="/tour">
      {{ $t('Tour') }}
      <app-badge :amount="list.length" />
    </router-link>
    <router-link to="/albums">{{ $t('Albums') }}</router-link>
    <router-link to="/videos">{{ $t('Videos') }}</router-link>
    <router-link to="/biography">{{ $t('Biography') }}</router-link>
    <router-link to="/contact">{{ $t('Contact') }}</router-link>
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
