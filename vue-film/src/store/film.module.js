import { FilmsService, CommentsService } from '@/common/api.service'
import {
  FETCH_FILM,
  FETCH_COMMENTS,
  COMMENT_CREATE,
  COMMENT_DESTROY,
  FILM_RESET_STATE
} from './actions.type'
import {
  RESET_STATE,
  SET_FILM,
  SET_COMMENTS
} from './mutations.type'

const getDefaultState = () => {
  return {
    film: {
      name: '',
      description: '',
      release_date: '',
      rating: '',
      ticket_price: '',
      country: '',
      photo: '',
      genreList: []
    },
    comments: []
  }
}

export const state = getDefaultState()

export const actions = {
  [FETCH_FILM] (context, filmSlug, prevFilm) {
    // avoid extronuous network call if film exists
    if (prevFilm !== undefined) {
      return context.commit(SET_FILM, prevFilm)
    }

    return FilmsService.get(filmSlug)
      .then(({ data }) => {
        context.commit(SET_FILM, data.film)
        return data
      })
  },
  [FETCH_COMMENTS] (context, filmSlug) {
    return CommentsService.get(filmSlug)
      .then(({ data }) => {
        context.commit(SET_COMMENTS, data.comments)
      })
  },
  [COMMENT_CREATE] (context, payload) {
    return CommentsService
      .post(payload.slug, payload.comment)
      .then(() => { context.dispatch(FETCH_COMMENTS, payload.slug) })
  },
  [COMMENT_DESTROY] (context, payload) {
    return CommentsService
      .destroy(payload.slug, payload.commentId)
      .then(() => {
        context.dispatch(FETCH_COMMENTS, payload.slug)
      })
  },
  [FILM_RESET_STATE] ({ commit }) {
    commit(RESET_STATE)
  }
}

/* eslint no-param-reassign: ["error", { "props": false }] */
export const mutations = {
  [SET_FILM] (state, film) {
    state.film = film
  },
  [SET_COMMENTS] (state, comments) {
    state.comments = comments
  },
  [RESET_STATE] () {
    Object.assign(state, getDefaultState())
  }
}

const getters = {
  film (state) {
    return state.film
  },
  comments (state) {
    return state.comments
  }
}

export default {
  state,
  actions,
  mutations,
  getters
}
