import axios from 'axios';

const moduleState = {
  list: [],
  isLoading: false,
  currentSong: 0,
  isPlaying: false,
};

const getters = {
  playableSongs: state => {
    let newArray = [];
    state.list.forEach(item => {
      const songs = item.songlist.filter(song => song.file !== null);
      newArray = [...newArray, ...songs];
    });
    return newArray;
  },
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
  selectSong: (state, payload) => {
    const newState = state;
    newState.currentSong = payload;
  },
  setPlayState: (state, payload) => {
    const newState = state;
    newState.isPlaying = payload;
  },
};

const actions = {
  set: async ({ commit }) => {
    commit('updateLoader', true);

    try {
      const response = await axios.get('site/v1/discography');
      commit('set', response.data);
      const songs = await getters.playableSongs(moduleState);

      if (songs.length) {
        const song = songs[0];
        commit('selectSong', song);
      }
    } finally {
      commit('updateLoader', false);
    }
  },
  selectSong: ({ commit }, payload) => {
    const songs = getters.playableSongs(moduleState);
    const song = songs.find(item => item === payload);
    commit('selectSong', song);
  },
  setPlayState: ({ commit }, payload) => {
    commit('setPlayState', payload);
  },
  selectNextSong: ({ commit }) => {
    const songs = getters.playableSongs(moduleState);
    const currentSong = moduleState.currentSong;
    const currentSongIndex = songs.findIndex(song => song === currentSong);

    let nextSongIndex;
    if (currentSongIndex + 1 >= songs.length) {
      nextSongIndex = 0;
    } else {
      nextSongIndex = currentSongIndex + 1;
    }
    commit('selectSong', songs[nextSongIndex]);
  },
};

export default {
  state: moduleState,
  getters,
  mutations,
  actions,
  namespaced: true,
};
