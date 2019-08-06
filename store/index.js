export const state = () => ({
  locales: ['en'],
  locale: 'en',
  step: 0
})

export const mutations = {
  SET_LANG(state, locale) {
    if (state.locales.includes(locale)) {
      state.locale = locale
    }
  },
  SET_STEP(state, step) {
    state.step = step
  }
}
