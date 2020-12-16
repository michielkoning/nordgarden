import albums from '~/data/albums'

export const state = () => ({
  list: albums,
  currentSong: null,
  isPlaying: false,
})

export const getters = {
  playableSongs: () => {
    let newArray = []
    albums.forEach((album) => {
      const songs = album.songlist.filter((song) => song.file !== undefined)
      const songsWithAlbum = songs.map((song) => {
        return {
          ...song,
          album: {
            title: album.title,
            image: album.image,
          },
        }
      })
      newArray = [...newArray, ...songsWithAlbum]
    })
    return newArray
  },
}

export const mutations = {
  selectSong: (state, payload) => {
    if (payload) state.currentSong = payload
  },
  setPlayState: (state, payload) => {
    state.isPlaying = payload
  },
}

export const actions = {
  selectSong({ commit }, payload) {
    const songs = getters.playableSongs()
    const song = songs.find((item) => item.file === payload.file)
    commit('selectSong', song)
  },
  setPlayState: ({ commit }, payload) => {
    commit('setPlayState', payload)
  },
  selectNextSong({ commit }, currentSong) {
    const songs = getters.playableSongs()
    const currentSongIndex = songs.findIndex(
      (song) => song.title === currentSong.title,
    )
    let nextSongIndex
    if (currentSongIndex + 1 >= songs.length) {
      nextSongIndex = 0
    } else {
      nextSongIndex = currentSongIndex + 1
    }
    commit('selectSong', songs[nextSongIndex])
  },
  selectPreviousSong({ commit }, currentSong) {
    const songs = getters.playableSongs()
    const currentSongIndex = songs.findIndex(
      (song) => song.title === currentSong.title,
    )
    let previousSongIndex
    if (currentSongIndex === 0) {
      previousSongIndex = songs.length - 1
    } else {
      previousSongIndex = currentSongIndex - 1
    }
    commit('selectSong', songs[previousSongIndex])
  },
}
