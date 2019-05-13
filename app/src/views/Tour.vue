<template>
  <app-page class="tour">
    <div class="text">
      <h1>{{ $t('tour') }}</h1>
      <ul>
        <li v-for="tour in list" :key="tour.date">
          <span class="date">{{ tour.date | formatDate }}</span>
          <span class="venue">{{ tour.venue }}</span>
          <span class="city">{{ tour.city }}</span>
        </li>
      </ul>
    </div>
    <img src="/img/tour.jpg" alt>
  </app-page>
</template>

<script>
import { mapState } from 'vuex';
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    AppPage,
  },
  filters: {
    formatDate(value) {
      const date = new Date(value);
      return `${date.getDate()}.${date.getMonth() + 1}`;
    },
  },
  computed: {
    ...mapState('tour', ['list']),
  },
};
</script>

<style lang="postcss" scoped>
.tour {
  background: #2f2e3e;
  color: #fff;
  display: flex;

  align-items: flex-start;
  font-size: 1.2em;
}

img {
  flex: 0 0 auto;
  height: auto;
  margin-left: 5rem;
}

.text {
  padding-top: 5em;
}

ul {
  @mixin list-reset;
}

.city,
.date,
.venue {
  display: inline-block;
  margin-right: 0.25em;
}

.venue,
h1 {
  color: #eb2860;
}
</style>
