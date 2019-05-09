import Vue from 'vue';
import Vuex from 'vuex';
import tour from './modules/tour';
import albums from './modules/albums';
import pages from './modules/pages';
import posts from './modules/posts';
import videos from './modules/videos';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    tour,
    albums,
    posts,
    pages,
    videos,
  },
});
