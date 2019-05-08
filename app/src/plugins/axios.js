import EventBusUtil from '@/utils/eventBusUtil';
import axios from 'axios';

axios.interceptors.response.use(
  response => response,
  error => {
    EventBusUtil.$emit('axios-interceptor-throws-error', error);
  },
);

axios.defaults.baseURL = `${process.env.VUE_APP_API_URL}/wp-json`;
