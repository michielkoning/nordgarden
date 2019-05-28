<template>
  <div class="alert">
    <div aria-live="polite" role="region">{{ message }}</div>
    <button v-if="message" @click="dismiss">Dismiss</button>
  </div>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil';

export default {
  data() {
    return {
      message: '',
    };
  },
  created() {
    EventBusUtil.$on('axios-interceptor-throws-error', error => this.handleError(error));
  },
  methods: {
    handleError(err) {
      this.message = err.message;
    },
    dismiss() {
      this.message = '';
    },
  },
};
</script>

<style lang="postcss" scoped>
.alert {
  position: fixed;
  bottom: 0;
  font-size: 1.25em;
  left: 0;
  right: 0;
  z-index: var(--error-handler);
  text-align: center;
  padding: 0.5em 0.25em;
  background: var(--color-bg-page);
  border-top: 2px solid var(--color-white);
}
</style>
