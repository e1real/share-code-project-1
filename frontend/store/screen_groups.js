import { queryBuildByFilterObject } from '@/utils/helpers'

export const state = () => ({
  screenGroupList: [],
  screenGroupListLoading: false,
  screenGroupListFetchError: null,
  screenGroupListFilter: {
    name: '',
    group: {
      id: '',
      name: 'All',
    },
    status: {
      title: 'All',
      value: '',
    },
    location: {
      id: '',
      name: 'All',
    },
    order_by: '',
    sort_by: '',
  },
  screenGroupListPagination: {
    total: undefined,
    current: 1,
    limit: 10,
    offset: 0,
  },
})

export const getters = {
  screenGroupList: (state) => state.screenGroupList,
  screenGroupListLoading: (state) => state.screenGroupListLoading,
  screenGroupListFetchError: (state) => state.screenGroupListFetchError,
  screenGroupListFilter: (state) => state.screenGroupListFilter,
  screenGroupListPagination: (state) => state.screenGroupListPagination,
}

export const mutations = {
  /**
   * @param {*} state
   * @param {Array} screenGroup
   */
  SET_SCREEN_GROUPS_LIST(state, screenGroup) {
    state.screenGroupList = screenGroup
  },
  /**
   * @param {*} state
   * @param {boolean} loading
   */
  SET_SCREEN_GROUPS_LIST_LOADING(state, loading) {
    state.screenGroupListLoading = loading
  },
  /**
   * @param {*} state
   * @param {*} error
   */
  SET_SCREEN_GROUPS_LIST_FETCH_ERROR(state, error) {
    state.screenGroupListFetchError = error
  },
  /**
   * @param {*} state
   * @param {Object} filters
   */
  SET_SCREEN_GROUPS_LIST_FILTERS(state, filters) {
    Object.assign(state.screenGroupListFilter, filters)
  },
  /**
   * @param {*} state
   * @param {Object} pagination
   */
  SET_SCREEN_GROUPS_LIST_PAGINATION(state, pagination) {
    Object.assign(state.screenGroupListPagination, pagination)
  },
}

export const actions = {
  async fetchScreenGroups({ commit, state }) {
    commit('SET_SCREEN_GROUPS_LIST_LOADING', true)

    const screenGroupListFilterQuery = {
      name: state.screenGroupListFilter.name,
      per_page: state.screenGroupListPagination.per_page,
    }
    const queryString = queryBuildByFilterObject(screenGroupListFilterQuery)
    try {
      const { data } = await this.$api.get(`screen-groups/?${queryString}`)

      commit('SET_SCREEN_GROUPS_LIST', data.data)
      commit('SET_SCREEN_GROUPS_LIST_PAGINATION', {
        ...data,
      })
    } catch (err) {
      commit('SET_SCREEN_GROUPS_LIST_FETCH_ERROR', err)
    }

    commit('SET_SCREEN_GROUPS_LIST_LOADING', false)
  },
  async createScreen({ commit, state }, payload) {
    // const { data } = await api.screenGroups.createScreen(payload);
    // console.log(data)
  },
}
