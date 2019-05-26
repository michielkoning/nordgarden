<template>
  <div aria-live="polite" role="region">{{ message }}</div>
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
  },
};
</script>
