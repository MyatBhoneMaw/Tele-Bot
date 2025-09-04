import axios from 'axios';
import router from '../router';
// Laravel backend URL
const API_BASE_URL = '/api'; // လိုအပ်ရင် .env file ထဲသို့ ရွှေ့လို့ရအောင်

// Axios instance
const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Accept': 'application/json',
    // Authorization: `Bearer ${token}`,
  },
});

//Auth token ထည့်ဖို့
api.interceptors.request.use(config => {
  const userStr = localStorage.getItem('user');
  if (userStr) {
    const user = JSON.parse(userStr);
    if (user.token) {
      config.headers.Authorization = `Bearer ${user.token}`;
    } 
  }
  return config;
});


//401 ဖြစ်ရင် login page ကို ပို့
api.interceptors.response.use(
  response => response,
  error => {
    if (error.response && error.response.status === 401) {
      localStorage.removeItem('user');
      router.push('/login');
    }
    

    return Promise.reject(error);
  }
);



// ==========================
//  CRUD API FUNCTIONS
// ==========================

// Create (POST) with file
export const post = async (endpoint, data, fileFieldName = 'file') => {
  const formData = new FormData();

  // Append normal data
  for (const key in data) {
    if (key !== fileFieldName) {
      formData.append(key, data[key]);
    }
  }

  // Append file
  if (data[fileFieldName]) {
    formData.append(fileFieldName, data[fileFieldName]);
  }

  const response = await api.post(endpoint, formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  });

  return response.data;
};

//only data no file
export const postJson = async (endpoint, data = {}) => {
  const response = await api.post(endpoint, data, {
    headers: {
      'Content-Type': 'application/json',
    },
  });

  return response.data;
};


//  Read (GET)
export const get = async (endpoint, params = {}) => {
  const response = await api.get(endpoint, { params });
  return response.data;
};

//  Update (PUT or POST) with file
export const put = async (endpoint, data, fileFieldName = 'file', method = 'POST') => {
  const formData = new FormData();

  // Append normal data
  for (const key in data) {
    if (key !== fileFieldName) {
      formData.append(key, data[key]);
    }
  }

  // Append file
  if (data[fileFieldName]) {
    formData.append(fileFieldName, data[fileFieldName]);
  }

  const response = await api.request({
    url: endpoint,
    method: method,
    data: formData,
    headers: { 'Content-Type': 'multipart/form-data' },
  });

  return response.data;
};

// Delete (DELETE)
export const destroy = async (endpoint) => {
  const response = await api.delete(endpoint);
  return response.data;
};

export default api;


//Create with file , file က null မဖြစ်မနေ ထည့်ပေးစရာ မလို
{/* <script setup>
import { ref } from 'vue';
import { post } from '@/utils/api';

const form = ref({
  name: '',
  description: '',
  file: null,
});

const handleFileChange = (e) => {
  form.value.file = e.target.files[0];
};

const submit = async () => {
  try {
    const response = await post('/documents', form.value, 'file');
    console.log('Created:', response);
  } catch (error) {
    console.error('Create Error:', error);
  }
};
</script>

<template>
  <form @submit.prevent="submit">
    <input v-model="form.name" placeholder="Name" />
    <input v-model="form.description" placeholder="Description" />
    <input type="file" @change="handleFileChange" />
    <button type="submit">Submit</button>
  </form>
</template> */}

// GET with data
{/* <script setup>
import { ref, onMounted } from 'vue';
import { get } from '@/utils/api';

const documents = ref([]);

const fetchDocuments = async () => {
  try {
    documents.value = await get('/documents');
  } catch (error) {
    console.error('Fetch Error:', error);
  }
};

onMounted(() => {
  fetchDocuments();
});
</script>

<template>
  <div v-for="doc in documents" :key="doc.id">
    <p>{{ doc.name }}</p>
  </div>
</template> */}


//Put data also file     
{/* <script setup>
import { ref } from 'vue';
import { put } from '@/utils/api';

const form = ref({
  id: 1,
  name: 'Updated Name',
  description: 'Updated Description',
  file: null,
});

const handleFileChange = (e) => {
  form.value.file = e.target.files[0];
};

const updateDocument = async () => {
  try {
    await put(`/documents/${form.value.id}`, form.value, 'file', 'POST'); // Laravel usually spoof PUT via POST
    console.log('Updated');
  } catch (error) {
    console.error('Update Error:', error);
  }
};
</script>

<template>
  <input v-model="form.name" placeholder="Name" />
  <input v-model="form.description" placeholder="Description" />
  <input type="file" @change="handleFileChange" />
  <button @click="updateDocument">Update</button>
</template> */}

// Delete data
{/* <script setup>
import { ref } from 'vue';
import { destroy } from '@/utils/api';

const deleteDocument = async (id) => {
  try {
    await destroy(`/documents/${id}`);
    console.log(`Document ${id} deleted`);
  } catch (error) {
    console.error('Delete Error:', error);
  }
};
</script>

<template>
  <button @click="deleteDocument(1)">Delete Document #1</button>
</template> */}


// Create with file
// await post('/posts', { title: 'Hello', content: 'World', file: selectedFile });

// Read
// const posts = await get('/posts');

// Update with PUT method
// await put('/posts/1', { title: 'Updated', file: newFile }, 'file', 'POST');

// Delete
// await destroy('/posts/1');
