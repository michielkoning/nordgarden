import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 };
  },
  routes: [
    {
      path: '/',
      component: Home,
      meta: {
        step: 0,
      },
    },
    {
      path: '/tour',
      name: 'tour',
      component: () => import(/* webpackChunkName: "tour" */ './views/Tour.vue'),
      meta: {
        step: 1,
      },
    },
    {
      path: '/albums',
      name: 'albums',
      component: () => import(/* webpackChunkName: "albums" */ './views/Albums.vue'),
      meta: {
        step: 2,
      },
    },
    {
      path: '/videos',
      name: 'videos',
      component: () => import(/* webpackChunkName: "videos" */ './views/Videos.vue'),
      meta: {
        step: 3,
      },
    },
    {
      path: '/biography',
      name: 'biography',
      component: () => import(/* webpackChunkName: "biography" */ './views/Biography.vue'),
      meta: {
        step: 4,
      },
    },
    {
      path: '/:post',
      name: 'post',
      component: () => import(/* webpackChunkName: "post" */ './views/Post.vue'),
      meta: {
        step: 0,
      },
    },
  ],
});
