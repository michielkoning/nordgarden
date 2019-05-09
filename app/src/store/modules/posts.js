import axios from 'axios';

const moduleState = {
  list: [],
  isLoading: false,
  currentPage: 1,
  totalPages: null,
};

const getters = {
  getBySlug: state => slug => state.list.find(post => post.slug === slug),
  hasAllPostsLoaded: state => state.totalPages && state.currentPage > state.totalPages,
};

const mutations = {
  setPosts: (state, payload) => {
    const newState = state;
    newState.list = [...state.list, ...payload];
    newState.currentPage += 1;
  },
  setTotalPages: (state, payload) => {
    const newState = state;
    newState.totalPages = payload;
  },
  updateLoader: (state, payload) => {
    const newState = state;
    newState.isLoading = payload;
  },
};

const actions = {
  setPosts: async ({ commit }) => {
    commit('updateLoader', true);

    try {
      const response = await axios.get('wp/v2/posts/', {
        params: {
          page: moduleState.currentPage,
        },
      });

      if (moduleState.currentPage === 1)
        commit('setTotalPages', response.headers['x-wp-totalpages']);

      commit('setPosts', response.data);
    } finally {
      commit('updateLoader', false);
    }
  },
};

export default {
  state: moduleState,
  getters,
  mutations,
  actions,
  namespaced: true,
};
