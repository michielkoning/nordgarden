import albums from '@/data/albums.json';

const moduleState = {
  list: albums,
  currentSong: albums[0].songlist.find(song => song.file !== null),
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
