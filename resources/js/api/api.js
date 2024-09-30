import axios from 'axios';
import { router } from '@inertiajs/vue3'

const apiClient = axios.create({
    withCredentials: true,
    baseURL: import.meta.env.baseUrl,
});

apiClient.interceptors.response.use(
    response => {
      return response;
    },
    error => {
      if (error.response) {
        const { status } = error.response;
        if ([403, 401].includes(status)) {
            router.get(route('web.register'));
            return;
        } 
      } 

      return Promise.reject(error);
    }
  );
  

export default apiClient;