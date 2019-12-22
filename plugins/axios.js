import axios from 'axios'
import EventBusUtil from '@/utils/eventBusUtil'
import { apiUrl } from '~/config/siteDetails'

const instance = axios.create({
  baseURL: `${apiUrl}wp-json/`
})

instance.interceptors.response.use(
  response => response,
  error => {
    EventBusUtil.$emit('axios-interceptor-throws-error', error)
  }
)

export default instance
