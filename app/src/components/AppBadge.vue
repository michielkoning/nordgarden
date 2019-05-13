<template>
  <span v-if="amount > 0" class="badge">{{ amount }}</span>
</template>

<script>
export default {
  props: {
    amount: {
      type: Number,
      required: true,
    },
  },
};
</script>

<style lang="postcss" scoped>
.badge {
  font-size: 0.8em;
  background: gray;
  min-width: 1.25em;
  height: 1.25em;
  margin-left: 0.25em;
  flex: 0 1 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  color: white;
  padding: 0 0.3em;
}
</style>
