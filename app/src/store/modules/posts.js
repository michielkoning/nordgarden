import axios from 'axios';

const moduleState = {
  list: [],
  isLoading: false,
};

const getters = {
  getBySlug: state => slug => state.list.find(post => post.slug === slug),
};

const mutations = {
  set: (state, payload) => {
    const newState = state;
    newState.list = [...state.list, ...payload];
  },
  updateLoader: (state, payload) => {
    const newState = state;
    newState.isLoading = payload;
  },
};

const actions = {
  set: async ({ commit }) => {
    commit('updateLoader', true);

    try {
      const response = await axios.get('wp/v2/posts/');
      commit('set', response.data);
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
