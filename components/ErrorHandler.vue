<template>
  <div
    class="alert"
    aria-live="polite"
    role="region"
    :class="{ active: message.length }"
  >
    <span class="text">{{ message }}</span>

    <button type="button" class="dismiss" @click="dismiss">
      <icon-close aria-hidden="true" width="24" height="24" />
      <span class="sr-only">{{ $t('close') }}</span>
    </button>
  </div>
</template>

<script>
import EventBusUtil from '@/utils/eventBusUtil'
import IconClose from '@/assets/icons/close.svg'

export default {
  components: {
    IconClose
  },
  data() {
    return {
      message: ''
    }
  },
  created() {
    EventBusUtil.$on('axios-interceptor-throws-error', error =>
      this.handleError(error)
    )
  },
  methods: {
    handleError(err) {
      this.message = err.message
    },
    dismiss() {
      this.message = ''
    }
  }
}
</script>

<style lang="postcss" scoped>
.alert {
  display: none;

  &.active {
    display: flex;
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
}

button {
  order: -1;
  margin: 0.25em 0.25em 0 0;
}

.text {
  flex: 1 1 auto;
  text-align: center;
}
</style>
