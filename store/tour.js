export const state = () => ({
  list: [],
  isLoading: false
})

export const mutations = {
  set: (state, payload) => {
    state.list = payload
  },
  updateLoader: (state, payload) => {
    state.isLoading = payload
  }
}

export const actions = {
  async set({ commit }) {
    commit('updateLoader', true)
    try {
      const response = await this.$axios.$get('site/v1/tours')
      commit('set', response)
    } finally {
      commit('updateLoader', false)
    }
  }
}
