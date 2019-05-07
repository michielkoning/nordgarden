import axios from 'axios';

const moduleState = {
  list: [],
};

const mutations = {
  set: (state, payload) => {
    const newState = state;
    newState.list = payload;
  },
};

const actions = {
  set: async ({ commit }) => {
    try {
      const response = await axios.get('wp/v2/posts/');
      commit('set', response.data);
    } catch (error) {
      window.console.error(error);
    } finally {
      // this.loading = false;
    }
  },
};

export default {
  state: moduleState,
  mutations,
  actions,
  namespaced: true,
};
