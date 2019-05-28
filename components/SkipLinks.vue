<template>
  <div class="skip-links">
    <a href="#content">Naar hoofdinhoud</a>
    <a href="#menu">Naar hoofdnavigatiemenu</a>
  </div>
</template>

<style lang="postcss" scoped>
a {
  background-color: var(--white);
  display: block;
  font-size: 1rem;
  left: -9999em;
  position: fixed;
  z-index: 1000;

  &:focus,
  &:active {
    top: 1rem;
    left: 1rem;
  }
}
</style>
