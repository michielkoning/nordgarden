<template>
  <app-page class="tour">
    <ul>
      <li v-for="tour in list" :key="tour.date">{{ tour.date }}</li>
    </ul>
  </app-page>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import AppPage from '@/components/AppPage.vue';

export default {
  components: {
    AppPage,
  },
  computed: {
    ...mapState('tour', ['list', 'isLoading']),
  },

  mounted() {
    if (!this.list.length) this.setTour();
  },
  methods: {
    ...mapActions({
      setTour: 'tour/set',
    }),
  },
};
</script>
