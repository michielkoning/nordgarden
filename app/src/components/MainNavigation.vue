<template>
  <nav aria-labelledby="menu-title" role="navigation">
    <h2 id="menu-title" class="sr-only" tabindex="-1">{{ $t('mainNavigation') }}</h2>
    <ul ref="list">
      <li>
        <router-link id="menu" to="/">
          <span class="title">{{ $t('home') }}</span>
        </router-link>
      </li>
      <li>
        <router-link to="/tour">
          <span class="title">{{ $t('tour') }}</span>
          <app-badge :amount="list.length" />
        </router-link>
      </li>
      <li>
        <router-link to="/albums">
          <span class="title">{{ $t('albums') }}</span>
        </router-link>
      </li>
      <li>
        <router-link to="/videos">
          <span class="title">{{ $t('videos') }}</span>
        </router-link>
      </li>
      <li>
        <router-link to="/biography">
          <span class="title">{{ $t('biography') }}</span>
        </router-link>
      </li>
    </ul>
    <div class="arrow" :style="{ transform: arrowPosition }" />
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
      arrowPosition: 0,
    };
  },
  watch: {
    $route(to, from) {
      const { step } = to.meta;
      const position = this.$refs.list.querySelector(`:nth-child(${step + 1}`).offsetTop;
      this.arrowPosition = `translateY(${position}px)`;
    },
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

li {
  padding: 0.25em 0;
}

.title {
  border-bottom: 2px solid transparent;
  transition: border-color 0.1s ease-out;
}

a {
  align-items: center;
  display: flex;
  position: relative;
  text-decoration: none;
  font-size: 1.2em;
  line-height: 1.1;

  &:hover {
    text-decoration: none;
    & .title {
      border-bottom-color: var(--color-primary);
    }
  }
}

.arrow {
  display: block;
  position: absolute;
  top: 0;
  right: -2em;
  transition: transform 0.2s ease-out;

  &::after {
    position: absolute;
    display: block;
    content: '';
    border-top: 0.75em solid transparent;
    border-bottom: 0.75em solid transparent;
    border-left: 1em solid var(--color-navigation);
  }

  &::before {
    position: absolute;
    display: block;
    content: '';
    margin-top: -3px;
    border-top: calc(0.75em + 3px) solid transparent;
    border-bottom: calc(0.75em + 3px) solid transparent;
    border-left: calc(1em + 6px) solid #fff;
  }
}
</style>
