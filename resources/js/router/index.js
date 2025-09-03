import { createRouter, createWebHistory } from 'vue-router';

import Home from '@/pages/home.vue';
import Login from '@/pages/login.vue';
import Create from '@/pages/create.vue'
import UserProfile from '../pages/userProfile.vue';
import Plan from '../pages/plan.vue';
import Employee from '../pages/employee.vue';
import PageNotFound from '../pages/404.vue';

const routes = [
{
path: '/',
name: 'Home',
component: Home,
},
{ 
  path: '/:pathMatch(.*)*',
  name: 'NotFound',
  component: PageNotFound
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
path : '/user-profile',
name : 'UserProfile',
component : UserProfile
},
{
path : '/plan',
name : 'Plan',
component : Plan
},
{
path : '/employee',
name : 'Employee',
component : Employee
}
];

const router = createRouter({
history: createWebHistory(),
routes,
});

export default router;
