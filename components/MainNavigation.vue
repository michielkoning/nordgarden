<template>
  <nav aria-labelledby="menu-title">
    <h2 id="menu-title" class="sr-only" tabindex="-1">
      {{ $t('mainNavigation') }}
    </h2>
    <ul ref="list">
      <li>
        <nuxt-link id="menu" to="/">
          <span class="title" :class="{ 'link-active': isCurrentStep(0) }">{{
            $t('home')
          }}</span>
        </nuxt-link>
      </li>
      <li>
        <nuxt-link to="/tour">
          <span class="title" :class="{ 'link-active': isCurrentStep(1) }">
            {{ $t('tour') }}
          </span>
          <app-badge :amount="list.length" />
        </nuxt-link>
      </li>
      <li>
        <nuxt-link to="/albums">
          <span class="title" :class="{ 'link-active': isCurrentStep(2) }">
            {{ $t('albums') }}
          </span>
        </nuxt-link>
      </li>
      <li>
        <nuxt-link to="/videos">
          <span class="title" :class="{ 'link-active': isCurrentStep(3) }">
            {{ $t('videos') }}
          </span>
        </nuxt-link>
      </li>
      <li>
        <nuxt-link to="/biography">
          <span class="title" :class="{ 'link-active': isCurrentStep(4) }">
            {{ $t('biography') }}
          </span>
        </nuxt-link>
      </li>
    </ul>
    <div class="arrow" :style="{ transform: arrowPosition }" />
  </nav>
</template>

<script>
import AppBadge from '@/components/AppBadge.vue'
import { mapState, mapActions } from 'vuex'

export default {
  components: {
    AppBadge
  },
  data() {
    return {
      arrowPosition: 0
    }
  },
  computed: {
    ...mapState('tour', ['list']),
    step() {
      return this.$store.state.step
    }
  },
  watch: {
    $route(to, from) {
      const position = this.$refs.list.querySelector(
        `:nth-child(${this.step + 1}`
      ).offsetTop
      this.arrowPosition = `translateY(${position}px)`
    }
  },
  mounted() {
    this.setTours()
  },
  methods: {
    ...mapActions({
      setTours: 'tour/set'
    }),
    isCurrentStep(step) {
      return this.step === step
    }
  }
}
</script>

<style lang="postcss" scoped>
nav {
  position: relative;
  padding: 0 env(safe-area-inset-right) 0 env(safe-area-inset-left);

  @media (--navigation-position-left) {
    padding: 0;
  }
}

ul {
  @mixin list-reset;

  margin-bottom: 1em;
  border-top: 1px dashed var(--color-gray);

  @media (--navigation-position-left) {
    border-top: 0;
  }
}

.title {
  transition: box-shadow 0.1s ease-out;
  &.link-active {
    box-shadow: 0 2px 0 0 var(--color-primary);
  }
}

a {
  @mixin link-reset;

  align-items: center;
  display: flex;
  position: relative;
  text-decoration: none;
  font-size: 1.2em;
  line-height: 1.1;
  padding: 0.45em 0;
  border-bottom: 1px dashed var(--color-gray);

  &:hover {
    text-decoration: none;
    & .title {
      box-shadow: 0 3px 0 0 var(--color-primary);
    }
  }
  @media (--navigation-position-left) {
    border-bottom: 0;
    padding: 0.25em 0;
  }
}

.arrow {
  @media (--navigation-position-left) {
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
}
</style>
