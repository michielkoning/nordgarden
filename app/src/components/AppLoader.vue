<template>
  <div class="loader">
    <span class="sr-only">{{ $t('loading') }}</span>
  </div>
</template>

<style scoped lang="postcss">
.loader {
  background: gray;
  border-top-left-radius: 2em;
  border-top-right-radius: 2em;
  width: 4em;
  height: 2em;
  overflow: hidden;
  position: relative;
  margin: 0 auto 1em;

  @nest button & {
    margin: 0 1em 0 0;
    font-size: 0.5em;
    display: inline-block;
    background: white;
    transform: translateY(0.2em);

    &::before, &::after {
      background: $color-cta;
    }
  }

  &::before,
  &::after {
    content: '';
    background-color: white;
    position: absolute;
  }

  &::before {
    animation: spinner-gauge 4s infinite ease;
    left: 50%;
    margin-left: -2px;
    bottom: 0.5em;
    width: 4px;
    height: 1.25em;
    transform-origin: 50% 100%;
  }

  &::after {
    border-radius: 50%;
    left: 50%;
    margin-left: -0.375em;
    bottom: 0;
    width: 0.75em;
    height: 0.75em;
  }
}

@keyframes spinner-gauge {
  0%,
  100% {
    transform: rotate(-50deg);
  }

  10%,
  80%,
  86% {
    transform: rotate(20deg);
  }

  20%,
  24% {
    transform: rotate(60deg);
  }

  40%,
  70% {
    transform: rotate(-20deg);
  }

  54%,
  62% {
    transform: rotate(70deg);
  }

  56% {
    transform: rotate(78deg);
  }

  58% {
    transform: rotate(73deg);
  }

  60% {
    transform: rotate(75deg);
  }

  83%,
  89% {
    transform: rotate(25deg);
  }
}
</style>
