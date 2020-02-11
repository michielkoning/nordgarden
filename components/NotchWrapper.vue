<template>
  <div class="notch-wrapper">
    <slot />
  </div>
</template>

<style lang="postcss" scoped>
.notch-wrapper {
  padding: env(safe-area-inset-top) env(safe-area-inset-right) 0
    env(safe-area-inset-left);
}
</style>
