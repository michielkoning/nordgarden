<template>
  <span v-if="amount > 0" :class="$style.badge">{{ amount }}</span>
</template>

<script>
export default {
  props: {
    amount: {
      type: Number,
      required: true
    }
  }
}
</script>

<style lang="postcss" module>
.badge {
  font-size: var(--font-size-sm);
  background: var(--text-color);
  min-width: 1.5em;
  height: 1.5em;
  border-radius: 1.5em;
  transform: translate3d(var(--spacing-xxs), 0, 0);
  flex: 0 1 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  color: var(--color-secondary);
  padding: 0 0var (--spacing-xl);
}
</style>
