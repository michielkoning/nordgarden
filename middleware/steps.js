export default ({ route, store }) => {
  // Take the last value (latest route child)
  const step = route.meta.reduce((step, meta) => meta.step || step, 0)
  store.commit('SET_STEP', step)
}
