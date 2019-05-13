<template>
  <div class="social-links">
    <app-icon icon="amazon" :title="`${'viewNordgardenOn'} amazon`" />
    <app-icon icon="spotify" :title="`${'viewNordgardenOn'} spotify`" />
    <app-icon icon="youtube" :title="`${'viewNordgardenOn'} youtube`" />
    <app-icon icon="last.fm" :title="`${'viewNordgardenOn'} last.fm`" />
    <app-icon icon="facebook" :title="`${'viewNordgardenOn'} facebook`" />
    <app-icon icon="twitter" :title="`${'viewNordgardenOn'} twitter`" />
  </div>
</template>

<script>
import AppIcon from '@/components/AppIcon.vue';

export default {
  components: {
    AppIcon,
  },
};
</script>
