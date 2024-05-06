export default {
    headers: (state) => {
      return state.list
    },
    headerById: (state) => (id) => {
        return state.list[0]
    }
  }
  