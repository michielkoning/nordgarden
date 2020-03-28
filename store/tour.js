import axios from '~/plugins/axios'
import { toursApiUrl } from '~/config/siteDetails'
export const state = () => ({
  list: [],
  isLoading: false,
})

export const mutations = {
  set: (state, payload) => {
    state.list = payload
  },
  updateLoader: (state, payload) => {
    state.isLoading = payload
  },
}

export const actions = {
  async set({ commit }) {
    commit('updateLoader', true)
    try {
      const response = await axios.get(toursApiUrl)
      if (response.data) {
        const tours = response.data.map((tour) => {
          return {
            name: tour.lineup.name,
            date: tour.datetime,
            venue: tour.venue.name === 'Unknown venue' ? null : tour.venue.name,
            city: tour.venue.city === 'Unknown' ? null : tour.venue.city,
            url: tour.url,
          }
        })
        commit('set', tours)
      }
    } finally {
      commit('updateLoader', false)
    }
  },
}
