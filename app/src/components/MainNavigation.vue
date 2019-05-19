<template>
  <nav aria-labelledby="menu-title">
    <h2 id="menu-title" class="sr-only" tabindex="-1">{{ $t('mainNavigation') }}</h2>
    <ul ref="list">
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
    <div class="arrow"  :style="{transform: arrowPosition}" />
  </nav>
</template>

<script>
import AppBadge from '@/components/AppBadge.vue';
import { mapState } from 'vuex';

export default {
  components: {
    AppBadge,
  },
  data() {
    return {
      arrowPosition: 0
    }
  },
  watch: {
    $route(to, from) {
      const { step }= to.meta;
      const position = this.$refs.list.querySelector(`:nth-child(${step + 1}`).offsetTop
      this.arrowPosition = `translateY(${position}px)`;
    }
  }, 
  computed: {
    ...mapState('tour', ['list']),
  },

  
};
</script>

<style lang="postcss" scoped>
nav {
  position: relative;
}

ul {
  @mixin list-reset;

  margin-bottom: 1em;
}

a {
  align-items: center;
  display: flex;
  position: relative;
}

.arrow {

  display: block;
  position: absolute;
  top: 0;
  right: -3em;
  border-top: 0.75em solid transparent; 
  border-bottom: 0.75em solid transparent;
  border-left: 1em solid #999;
  transition: transform 0.2s ease-out;
}
</style>
