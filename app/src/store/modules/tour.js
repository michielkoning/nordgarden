import axios from 'axios';

const moduleState = {
  list: [],
  isLoading: false,
};

const mutations = {
  set: (state, payload) => {
    const newState = state;
    newState.list = payload;
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
      const response = await axios.get('site/v1/tours');
      commit('set', response.data);
    } finally {
      commit('updateLoader', false);
    }
  },
};

export default {
  state: moduleState,
  mutations,
  actions,
  namespaced: true,
};
