<template>
  <div id="app">
    <error-handler />
    <app-menu />
    <div class="page">
      <transition name="slide-next">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
import AppMenu from '@/components/AppMenu.vue';
import ErrorHandler from '@/components/ErrorHandler.vue';

export default {
  components: {
    AppMenu,
    ErrorHandler,
  },
};
</script>

<style scoped lang="postcss">
@import './styles/base.css';

.page {
  padding-left: 20em;
}

.slide-next-enter-active,
.slide-previous-enter-active {
  transition: all 0.15s 0.15s;
}

.slide-next-leave-active,
.slide-previous-leave-active {
  transition: all 0.15s;
}

.slide-next-enter {
  transform: translateY(-100vh);
}

.slide-previous-enter {
  transform: translateY(100vh);
}
.slide-next-leave-active {
  transform: translateY(100vh);
}

.slide-previous-leave-active {
  transform: translateY(-100vh);
}
</style>
