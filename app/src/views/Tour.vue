<template>
  <div class="tours">
    <ul>
      <li v-for="tour in tours" :key="tour.date">{{ tour.date }}</li>
    </ul>
    {{ tours }}
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      tours: [],
      isLoading: false,
    };
  },
  mounted() {
    this.getTours();
  },
  methods: {
    async getTours() {
      this.loading = true;
      try {
        const response = await axios.get('site/v1/tours');
        this.tours = response.data;
      } catch (error) {
        window.console.error(error);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
