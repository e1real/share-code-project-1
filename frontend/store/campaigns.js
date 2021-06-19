import { queryBuildByFilterObject } from '~/utils/helpers'

export const state = () => ({
  campaignsList: [],
  campaignsListLoading: false,
  campaignsListFetchError: null,
  campaignsListFilter: {
    name: '',
    status: {
      name: 'All',
      delivery_status_id: '',
    },
    start_date: undefined,
    end_date: undefined,
    order_by: '',
    sort_by: '',
  },
  campaignsListPagination: {
    total: undefined,
    current_page: 1,
    per_page: 10,
  },
  campaignDeliveryStatusList: [],
  campaignDeliveryStatusListFetchError: null,
  campaignDeliveryStatusListLoading: false,
})

export const getters = {
  campaignsList: (state) => state.campaignsList,
  campaignsListLoading: (state) => state.campaignsListLoading,
  campaignsListFetchError: (state) => state.campaignsListFetchError,
  campaignsListFilter: (state) => state.campaignsListFilter,
  campaignsListPagination: (state) => state.campaignsListPagination,
  campaignDeliveryStatusList: (state) => state.campaignDeliveryStatusList,
  campaignDeliveryStatusListFetchError: (state) =>
    state.campaignDeliveryStatusListFetchError,
  campaignDeliveryStatusListLoading: (state) =>
    state.campaignDeliveryStatusListLoading,
}

export const mutations = {
  /**
   * @param {*} state
   * @param {Array} campaigns
   */
  SET_CAMPAIGNS_LIST(state, campaigns) {
    state.campaignsList = campaigns
  },
  /**
   * @param {*} state
   * @param {boolean} loading
   */
  SET_CAMPAIGNS_LIST_LOADING(state, loading) {
    state.campaignsListLoading = loading
  },
  /**
   * @param {*} state
   * @param {*} error
   */
  SET_CAMPAIGNS_LIST_FETCH_ERROR(state, error) {
    state.campaignsListFetchError = error
  },
  /**
   * @param {*} state
   * @param {Object} filters
   */
  SET_CAMPAIGNS_LIST_FILTERS(state, filters) {
    Object.assign(state.campaignsListFilter, filters)
  },
  /**
   * @param {*} state
   * @param {Object} pagination
   */
  SET_CAMPAIGNS_LIST_PAGINATION(state, pagination) {
    Object.assign(state.campaignsListPagination, pagination)
  },
  /**
   * @param {*} state
   * @param {Array} statuses - delivery statuses
   */
  SET_CAMPAIGNS_DELIVERY_STATUS_LIST(state, statuses) {
    state.campaignDeliveryStatusList = statuses
  },
  /**
   * @param {*} state
   * @param {*} error
   */
  SET_CAMPAIGNS_DELIVERY_STATUS_LIST_FETCH_ERROR(state, error) {
    state.campaignDeliveryStatusListFetchError = error
  },
  /**
   * @param {*} state
   * @param {boolean} loading
   */
  SET_CAMPAIGNS_DELIVERY_STATUS_LIST_LOADING(state, loading) {
    state.campaignDeliveryStatusListLoading = loading
  },
}

export const actions = {
  async fetchCampaigns({ commit, state }) {
    commit('SET_CAMPAIGNS_LIST_LOADING', true)
    const campaignsListFilterQuery = {
      name: state.campaignsListFilter.name,
      status: state.campaignsListFilter.status.delivery_status_id,
      start_date: state.campaignsListFilter.start_date,
      end_date: state.campaignsListFilter.end_date,
      per_page: state.campaignsListPagination.per_page,
      page: state.campaignsListPagination.current_page,
      order_by: state.campaignsListFilter.order_by,
      sort_by: state.campaignsListFilter.sort_by,
    }
    const queryString = queryBuildByFilterObject(campaignsListFilterQuery)

    const { data } = await this.$api.get(`campaigns?${queryString}`)
    commit('SET_CAMPAIGNS_LIST_PAGINATION', {
      ...data,
    })
    commit('SET_CAMPAIGNS_LIST_LOADING', false)
    commit('SET_CAMPAIGNS_LIST', data.data)
  },
  async fetchCampaignDeliveryStatuses({ commit, state }) {
    commit('SET_CAMPAIGNS_DELIVERY_STATUS_LIST_LOADING', true)
    try {
      const { data } = await this.$api(`campaigns/delivery-status`)
      commit('SET_CAMPAIGNS_DELIVERY_STATUS_LIST', data)
    } catch (err) {
      commit('SET_CAMPAIGNS_DELIVERY_STATUS_LIST_FETCH_ERROR', err)
    }
    commit('SET_CAMPAIGNS_DELIVERY_STATUS_LIST_LOADING', false)
  },
}
