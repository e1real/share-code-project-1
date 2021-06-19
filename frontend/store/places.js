import { queryBuildByFilterObject } from '~/utils/helpers'

export const state = () => ({
  placeList: [],
  placeListLoading: false,
  placeListFetchError: null,
  placeListFilter: {
    name: '',
    status: {
      title: 'All',
      value: '',
    },
    date_start: undefined,
    date_stop: undefined,
    order_by: '',
    sort_by: '',
  },
  placeListPagination: {
    total: undefined,
    current_page: 1,
    per_page: 10,
  },
  placeCreateLoading: false,
  placeCreateError: undefined,
})

export const getters = {
  placeList: (state) => state.placeList,
  placeListLoading: (state) => state.placeListLoading,
  placeListFetchError: (state) => state.placeListFetchError,
  placeListFilter: (state) => state.placeListFilter,
  placeListPagination: (state) => state.placeListPagination,
  placeCreateLoading: (state) => state.placeCreateLoading,
  placeCreateError: (state) => state.placeCreateError,
}

export const mutations = {
  /**
   * @param {*} state
   * @param {Array} place
   */
  SET_PLACE_LIST(state, place) {
    state.placeList = place
  },
  /**
   * @param {*} state
   * @param {boolean} loading
   */
  SET_PLACE_LIST_LOADING(state, loading) {
    state.placeCreateLoading = loading
  },
  /**
   * @param {*} state
   * @param {*} error
   */
  SET_PLACE_LIST_FETCH_ERROR(state, error) {
    state.placeListFetchError = error
  },
  /**
   * @param {*} state
   * @param {Object} filters
   */
  SET_PLACE_LIST_FILTERS(state, filters) {
    Object.assign(state.placeListFilter, filters)
  },
  /**
   * @param {*} state
   * @param {Object} pagination
   */
  SET_PLACE_LIST_PAGINATION(state, pagination) {
    Object.assign(state.placeListPagination, pagination)
  },
  /**
   * @param {*} state
   * @param {boolean} loading
   */
  SET_CREATE_PLACE_LOADING(state, loading) {
    state.placeListLoading = loading
  },
  /**
   * @param {*} state
   * @param {*} error
   */
  SET_CREATE_PLACE_ERROR(state, error) {
    state.placeCreateError = error
  },
}

export const actions = {
  async fetchPlaces({ commit, state }) {
    commit('SET_PLACE_LIST_LOADING', true)

    const placeListFilterQuery = {
      limit: state.placeListPagination.limit,
      offset: state.placeListPagination.offset,
      per_page: state.placeListPagination.per_page,
      page: state.placeListPagination.current_page,
    }
    const queryString = queryBuildByFilterObject(placeListFilterQuery)

    try {
      const { data } = await this.$api.get(`places/?${queryString}`)
      if ('data' in data) {
        commit('SET_PLACE_LIST_PAGINATION', { ...data })
        commit('SET_PLACE_LIST', data.data)
      } else {
        commit('SET_PLACE_LIST', data)
      }
    } catch (err) {
      commit('SET_PLACE_LIST_FETCH_ERROR', err)
    }

    commit('SET_PLACE_LIST_LOADING', false)
  },
  async createPlace({ commit, state }, payload) {
    try {
      commit('SET_CREATE_PLACE_LOADING', true)
      const { data } = await this.$api.post('places/', {
        ...payload,
      })
      if ('data' in data) {
        commit('SET_PLACE_LIST_PAGINATION', { ...data })
        commit('SET_PLACE_LIST', data.data)
      } else {
        commit('SET_PLACE_LIST', data)
      }
    } catch (err) {
      if (err.response.status === 422) {
        commit('SET_CREATE_PLACE_ERROR', err.response.data.errors)
        // const errors = [];
        // for (const field in err.response.data.errors) {
        // if (typeof this.formErrors[field] !== 'undefined') {
        //   this.formErrors[field] = err.response.data.errors[field][0]
        // }
        // }
      }
      commit('SET_PLACE_LIST_FETCH_ERROR', err)
    }
  },
  async fetchPlaceById({ commit }, { payload }) {
    try {
      commit('SET_CREATE_PLACE_LOADING', true)
      const { data } = await this.$api.post('places/', {
        ...payload,
      })
      if ('data' in data) {
        commit('SET_PLACE_LIST_PAGINATION', { ...data })
        commit('SET_PLACE_LIST', data.data)
      } else {
        commit('SET_PLACE_LIST', data)
      }
    } catch (err) {
      if (err.response.status === 422) {
        commit('SET_CREATE_PLACE_ERROR', err.response.data.errors)
        // const errors = [];
        // for (const field in err.response.data.errors) {
        // if (typeof this.formErrors[field] !== 'undefined') {
        //   this.formErrors[field] = err.response.data.errors[field][0]
        // }
        // }
      }
      commit('SET_PLACE_LIST_FETCH_ERROR', err)
    }
  },
}
