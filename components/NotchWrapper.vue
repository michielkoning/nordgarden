<template>
  <div class="notch-wrapper">
    <slot />
  </div>
</template>

<style lang="postcss">
.notch-wrapper {
  padding: env(safe-area-inset-top) env(safe-area-inset-right)
    env(safe-area-inset-bottom) env(safe-area-inset-left);
}
</style>
