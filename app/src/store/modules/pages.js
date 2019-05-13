import axios from 'axios';

const moduleState = {
  about: null,
  biography: null,
  isLoading: false,
};

const mutations = {
  setAboutPage: (state, payload) => {
    const newState = state;
    newState.about = payload;
  },
  setBiographyPage: (state, payload) => {
    const newState = state;
    newState.biography = payload;
  },
  updateLoader: (state, payload) => {
    const newState = state;
    newState.isLoading = payload;
  },
};

const actions = {
  setPage: async ({ commit }, payload) => {
    commit('updateLoader', true);
    try {
      if (payload === 'about') {
        const response = await axios.get('wp/v2/pages/', {
          params: {
            slug: 'home',
          },
        });
        commit('setAboutPage', response.data[0]);
      } else {
        const response = await axios.get('wp/v2/pages/', {
          params: {
            slug: 'biography',
          },
        });
        commit('setBiographyPage', response.data[0]);
      }
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
