<template>
  <div>
    <h1>{{ $t('tour') }}</h1>
    <app-loader v-if="isLoading" />
    <template v-else>
      <ul v-if="list.length">
        <li v-for="tour in list" :key="tour.date">
          <span class="date">{{ tour.date | formatDate }}</span>
          <div>
            <span class="venue">{{ tour.venue }}</span>
            <span class="city">{{ tour.city }}</span>
          </div>
        </li>
      </ul>
      <p v-else>{{ $('noTourDays') }}</p>
    </template>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import AppLoader from '@/components/AppLoader.vue';

export default {
  components: {
    AppLoader,
  },
  filters: {
    formatDate(value) {
      const date = new Date(value);
      return `${date.getDate()}.${date.getMonth() + 1}`;
    },
  },
  computed: {
    ...mapState('tour', ['list', 'isLoading']),
  },
};
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;
}

li {
  display: flex;
}

.date {
  flex: 0 0 3em;
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
