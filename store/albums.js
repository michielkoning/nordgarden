import albums from '@/data/albums.json'

export const state = () => ({
  list: albums,
  currentSong: albums[0].songlist.find(song => song.file !== undefined),
  isPlaying: false
})

export const getters = {
  playableSongs: state => {
    let newArray = []
    state.list.forEach(album => {
      const songs = album.songlist.filter(song => song.file !== undefined)
      newArray = [...newArray, ...songs]
    })
    return newArray
  }
}

export const mutations = {
  selectSong: (state, payload) => {
    const newState = state
    newState.currentSong = payload
  },
  setPlayState: (state, payload) => {
    const newState = state
    newState.isPlaying = payload
  }
}

export const actions = {
  selectSong: ({ commit }, payload) => {
    const songs = getters.playableSongs(state)
    const song = songs.find(item => item === payload)
    commit('selectSong', song)
  },
  setPlayState: ({ commit }, payload) => {
    commit('setPlayState', payload)
  },
  selectNextSong: ({ commit }) => {
    const songs = getters.playableSongs(state)
    const currentSong = state.currentSong
    const currentSongIndex = songs.findIndex(song => song === currentSong)

    let nextSongIndex
    if (currentSongIndex + 1 >= songs.length) {
      nextSongIndex = 0
    } else {
      nextSongIndex = currentSongIndex + 1
    }
    commit('selectSong', songs[nextSongIndex])
  }
}
