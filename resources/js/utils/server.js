import axios from 'axios';

const apiClient = axios.create({
  baseURL: '/api', // API Prefix
  withCredentials: true,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'Content-Type': 'application/json',
  },
});

// Add Authorization header dynamically (optional)
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem('token'); // Adjust as needed
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// CSRF Cookie for Sanctum
async function getCsrfToken() {
  await apiClient.get('/sanctum/csrf-cookie');
}

export { apiClient, getCsrfToken };
