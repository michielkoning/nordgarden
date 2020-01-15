<template>
  <span v-if="amount > 0" class="badge">{{ amount }}</span>
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

<style lang="postcss" scoped>
.badge {
  font-size: var(--font-size-sm);
  background: var(--text-color);
  min-width: 1.25em;
  height: 1.25em;
  transform: translate3d(var(--spacing-xxs), 0, 0);
  flex: 0 1 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 1.25em;
  color: var(--color-secondary);
  padding: 0 0var (--spacing-xl);
}
</style>
