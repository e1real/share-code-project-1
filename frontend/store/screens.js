import { queryBuildByFilterObject } from '~/utils/helpers'

export const state = () => ({
  screenList: [],
  screenListLoading: false,
  screenListFetchError: null,
  screenListFilter: {
    name: '',
    group: {
      screen_group_id: '',
      name: 'All',
    },
    status: {
      title: 'All',
      value: '',
    },
    place: {
      place_id: '',
      name: 'All',
    },
    order_by: '',
    sort_by: '',
  },
  screenListPagination: {
    total: undefined,
    current_page: 1,
    per_page: 10,
  },
})

export const getters = {
  screenList: (state) => state.screenList,
  screenListLoading: (state) => state.screenListLoading,
  screenListFetchError: (state) => state.screenListFetchError,
  screenListFilter: (state) => state.screenListFilter,
  screenListPagination: (state) => state.screenListPagination,
}

export const mutations = {
  /**
   * @param {*} state
   * @param {Array} screen
   */
  SET_SCREEN_LIST(state, screen) {
    state.screenList = screen
  },
  /**
   * @param {*} state
   * @param {boolean} loading
   */
  SET_SCREEN_LIST_LOADING(state, loading) {
    state.screenListLoading = loading
  },
  /**
   * @param {*} state
   * @param {*} error
   */
  SET_SCREEN_LIST_FETCH_ERROR(state, error) {
    state.screenListFetchError = error
  },
  /**
   * @param {*} state
   * @param {Object} filters
   */
  SET_SCREEN_LIST_FILTERS(state, filters) {
    Object.assign(state.screenListFilter, filters)
  },
  /**
   * @param {*} state
   * @param {Object} pagination
   */
  SET_SCREEN_LIST_PAGINATION(state, pagination) {
    Object.assign(state.screenListPagination, pagination)
  },
}

export const actions = {
  async fetchScreens({ commit, state }) {
    commit('SET_SCREEN_LIST_LOADING', true)

    const screenListFilterQuery = {
      name: state.screenListFilter.name,
      group: state.screenListFilter.group.screen_group_id,
      place: state.screenListFilter.place.place_id,
      status: state.screenListFilter.status.value,
      limit: state.screenListPagination.limit,
      offset: state.screenListPagination.offset,
      per_page: state.screenListPagination.per_page,
      page: state.screenListPagination.current_page,
    }
    const queryString = queryBuildByFilterObject(screenListFilterQuery)
    try {
      const { data } = await this.$api.get(`screens?${queryString}`)
      commit('SET_SCREEN_LIST', data.data)
      commit('SET_SCREEN_LIST_PAGINATION', {
        ...data,
      })
    } catch (err) {
      commit('SET_SCREEN_LIST_FETCH_ERROR', err)
    }

    commit('SET_SCREEN_LIST_LOADING', false)
  },
}
