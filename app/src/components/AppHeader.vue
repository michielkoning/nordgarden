<template>
  <header>
    <mobile-navigation @toggleMenu="toggleMenu" />
    <transition
      name="fade2"
      @after-enter="afterEnter"
      @after-leave="afterLeave"
      @before-leave="beforeLeave"
    >
      <div v-show="showMenu" class="bg">
        <transition name="fade">
          <div v-show="showMenu" ref="bg" class="content">
            <h1>
              <router-link to="/">Nordgarden</router-link>
            </h1>
            <main-navigation />
            <audio-player />
            <social-links />
          </div>
        </transition>
      </div>
    </transition>
  </header>
</template>

<script>
import AudioPlayer from '@/components/AudioPlayer.vue';
import MainNavigation from '@/components/MainNavigation.vue';
import SocialLinks from '@/components/SocialLinks.vue';
import MobileNavigation from '@/components/MobileNavigation.vue';

const bodyScrollLock = require('body-scroll-lock');

export default {
  components: {
    AudioPlayer,
    SocialLinks,
    MainNavigation,
    MobileNavigation,
  },
  data() {
    return {
      showMenu: false,
    };
  },

  methods: {
    toggleMenu(status) {
      this.showMenu = status;
    },
    afterEnter() {
      const bg = this.$refs.bg;
      bodyScrollLock.disableBodyScroll(bg);
    },
    beforeLeave() {
      const bg = this.$refs.bg;
      bg.scrollTop = 0;
    },
    afterLeave() {
      const bg = this.$refs.bg;
      bodyScrollLock.enableBodyScroll(bg);
    },
  },
};
</script>

<style lang="postcss" scoped>
.content {
  padding: var(--gutter);
  overflow: auto;
  -webkit-overflow-scrolling: touch;
  max-height: 80vh;

  @media (--navigation-position-left) {
    padding-top: 0;
    overflow: visible;
    transform: translateY(0);
    display: block !important;
    max-height: none;
  }
}

.bg {
  position: fixed;
  top: 0;
  background: #999;
  left: 0;
  right: 0;
  bottom: 0;
  height: 100vh;
  padding-top: 3em;
  overflow: hidden;
  z-index: var(--main-navigation);

  @media (--navigation-position-left) {
     overflow: visible;
    padding-top: var(--gutter);
    display: block !important;
    width: var(--width-navigation-left);
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s 0.2s;
}

.fade-enter,
.fade-leave-to {
  transform: translateY(-2em);
  opacity: 0;
}

.fade2-enter-active,
.fade2-leave-active {
  transition: transform 0.3s;
}

.fade2-enter,
.fade2-leave-to {
  transform: translateY(-100vh);
}
</style>
