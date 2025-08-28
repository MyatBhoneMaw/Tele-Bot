import { createRouter, createWebHistory } from 'vue-router';

import Home from '@/pages/home.vue';
import Login from '@/pages/login.vue';
import Create from '@/pages/create.vue'
import UserCardDetail from '../pages/userCardDetail.vue';
import UserProfile from '../pages/userProfile.vue';
import Plan from '../pages/plan.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path : '/login',
    name : Login,
    component : Login
  },
  {
    path : '/user-create',
    name : 'Create',
    component : Create
  },
  {
    path : '/user/:id',
    name : 'UserCardDetail',
    component : UserCardDetail
  },
  {
    path : '/user-profile',
    name : 'UserProfile',
    component : UserProfile
  },
  {
    path : '/plan',
    name : 'Plan',
    component : Plan
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
