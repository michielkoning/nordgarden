<template>
  <div class="tour">
    <ul>
      <li v-for="tour in list" :key="tour.date">{{ tour.date }}</li>
    </ul>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';

export default {
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
