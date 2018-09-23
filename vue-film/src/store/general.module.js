import {
  FilmsService
} from '@/common/api.service'
import {
  FETCH_FILMS
} from './actions.type'
import {
  FETCH_START,
  FETCH_END
} from './mutations.type'

const state = {
  genres: [],
  films: [],
  isLoading: true,
  filmsCount: 0
}

const getters = {
  filmsCount (state) {
    return state.filmsCount
  },
  films (state) {
    return state.films
  },
  isLoading (state) {
    return state.isLoading
  }
}

const actions = {
  [FETCH_FILMS] ({ commit }, params) {
    commit(FETCH_START)
    return FilmsService.query(params.type, params.filters)
      .then(({ data }) => {
        commit(FETCH_END, data)
      })
      .catch((error) => {
        throw new Error(error)
      })
  }
}

/* eslint no-param-reassign: ["error", { "props": false }] */
const mutations = {
  [FETCH_START] (state) {
    state.isLoading = true
  },
  [FETCH_END] (state, { films, filmsCount }) {
    state.films = films
    state.filmsCount = filmsCount
    state.isLoading = false
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
