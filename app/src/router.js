import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      component: Home,
    },
    {
      path: '/tour',
      name: 'tour',
      component: () => import(/* webpackChunkName: "tour" */ './views/Tour.vue'),
    },
    {
      path: '/albums',
      name: 'albums',
      component: () => import(/* webpackChunkName: "albums" */ './views/Albums.vue'),
    },
    {
      path: '/videos',
      name: 'videos',
      component: () => import(/* webpackChunkName: "videos" */ './views/Videos.vue'),
    },
    {
      path: '/:post',
      name: 'post',
      component: () => import(/* webpackChunkName: "post" */ './views/Post.vue'),
    },
  ],
});
