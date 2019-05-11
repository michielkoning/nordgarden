<template>
  <div id="app">
    <error-handler />
    <app-menu />
    <div class="page">
      <transition :name="transitionName">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
import AppMenu from '@/components/AppMenu.vue';
import ErrorHandler from '@/components/ErrorHandler.vue';
import { mapActions } from 'vuex';

export default {
  components: {
    AppMenu,
    ErrorHandler,
  },
  data() {
    return {
      transitionName: '',
    };
  },
  watch: {
    $route(to, from) {
      if (to.meta.step < from.meta.step) {
        this.transitionName = 'slide-next';
      } else {
        this.transitionName = 'slide-previous';
      }
    },
  },
  mounted() {
    this.setTour();
    this.setAlbums();
  },
  methods: {
    ...mapActions({
      setAlbums: 'albums/set',
      setTour: 'tour/set',
    }),
  },
};
</script>

<style scoped lang="postcss">
@import './styles/base.css';

.slide-next-enter,
.slide-previous-enter {
  opacity: 0;
}

.slide-next-enter-active,
.slide-previous-enter-active {
  transition: all 0.15s 0.15s;
}

.slide-next-leave-active,
.slide-previous-leave-active {
  transition: all 0.15s;
  opacity: 0;
}

.slide-next-enter {
  transform: translateX(-2em);
}

.slide-previous-enter {
  transform: translateX(2em);
}

.slide-next-leave-active {
  transform: translateX(2em);
}

.slide-previous-leave-active {
  transform: translateX(-2em);
}

@media (--landscape) and (--viewport-md) {
  .slide-next-enter {
    transform: translateY(-2em);
  }

  .slide-previous-enter {
    transform: translateY(2em);
  }

  .slide-next-leave-active {
    transform: translateY(2em);
  }

  .slide-previous-leave-active {
    transform: translateY(-2em);
  }
}
</style>
