<template>
  <div class="page-wrapper">
    <div class="page">
      <PageBreadcrumbs class="page__breadcrumbs" :items="breadcrumbs" />
      <div class="page__page-head page-head">
        <h4 class="page-head__title">Campaigns</h4>
        <BaseButton
          class="page-head__button"
          label="Create campaign"
          @click="$router.push('/campaigns/create')"
        >
          <template #icon>
            <svg
              width="16"
              height="16"
              viewBox="0 0 16 16"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12.6666 8.66683H8.66665V12.6668H7.33331V8.66683H3.33331V7.3335H7.33331V3.3335H8.66665V7.3335H12.6666V8.66683Z"
                fill="white"
              />
            </svg>
          </template>
        </BaseButton>
      </div>
      <div class="page__search-filter search-filter">
        <div class="search-filter__autocomplete">
          <b-input
            v-model="campaignsName"
            placeholder="Search..."
            type="search"
            icon="magnify"
            icon-clickable
            @icon-click="handleChangeFilter('name')"
            @keyup.enter.native="handleChangeFilter('name')"
          >
          </b-input>
        </div>
        <div class="search-filter__filters">
          <VSelect
            v-model="campaignsStatus"
            class="search-filter__status"
            :options="deliveryStatusOptions"
            title-key="name"
            label="Status"
            @change="handleChangeFilter('status')"
          />
          <div class="search-filter__filters-date-range">
            <VDatePicker
              v-model="dateStart"
              label="Start date"
              @change="handleChangeFilter('start_date')"
            />
            <span class="search-filter__filters-date-range-dash"> - </span>
            <VDatePicker
              v-model="dateStop"
              label="End date"
              @change="handleChangeFilter('end_date')"
            />
          </div>
        </div>
      </div>
      <hr class="page__line" />
      <div class="page__table-wrapper">
        <CampaignsTable
          :loading="campaignsListLoading"
          :items="campaignsList"
          @sort="handleSortList"
        />
        <b-pagination
          v-model="currentPage"
          class="page__table-pagination"
          :total="campaignsListPagination.total"
          :range-before="3"
          :range-after="3"
          order="is-centered"
          size="default"
          icon-prev="prev"
          icon-next="nextIcon"
          :simple="false"
          :rounded="false"
          :per-page="campaignsListPagination.per_page"
          aria-next-label="Next page"
          aria-previous-label="Previous page"
          aria-page-label="Page"
          aria-current-label="Current page"
          @change="fetchCampaigns()"
        >
        </b-pagination>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import CampaignsTable from '~/components/table/CampaignsTable'
import BaseButton from '~/components/button/BaseButton'
import VSelect from '~/components/form/VSelect'
import VDatePicker from '~/components/form/VDatePicker'
import PageBreadcrumbs from '~/components/breadcrumb/PageBreadcrumbs'

export default {
  components: {
    CampaignsTable,
    BaseButton,
    PageBreadcrumbs,
    VSelect,
    VDatePicker,
  },
  data() {
    return {
      breadcrumbs: [
        {
          title: 'Home',
          to: '/',
        },
        {
          title: 'Campaigns',
          to: '',
        },
      ],
      autocompleteValue: '',
      deliveryStatusOptions: [],
    }
  },
  computed: {
    ...mapGetters({
      campaignsListLoading: 'campaigns/campaignsListLoading',
      campaignsList: 'campaigns/campaignsList',
      campaignsListPagination: 'campaigns/campaignsListPagination',
      campaignDeliveryStatusList: 'campaigns/campaignDeliveryStatusList',
    }),
    campaignsName: {
      get() {
        return this.$store.state.campaigns.campaignsListFilter.name
      },
      set(value) {
        this.$store.commit('campaigns/SET_CAMPAIGNS_LIST_FILTERS', {
          name: value,
        })
      },
    },
    campaignsStatus: {
      get() {
        return this.$store.state.campaigns.campaignsListFilter.status
      },
      set(value) {
        this.$store.commit('campaigns/SET_CAMPAIGNS_LIST_FILTERS', {
          status: value,
        })
      },
    },
    dateStart: {
      get() {
        const parsedDateStart = Date.parse(
          this.$store.state.campaigns.campaignsListFilter.start_date
        )
        if (parsedDateStart) {
          return new Date(parsedDateStart)
        }
        return undefined
      },
      set(value) {
        this.$store.commit('campaigns/SET_CAMPAIGNS_LIST_FILTERS', {
          start_date: `${value.getFullYear()}-${
            value.getMonth() + 1
          }-${value.getDate()}`,
        })
      },
    },
    dateStop: {
      get() {
        const parsedDateStop = Date.parse(
          this.$store.state.campaigns.campaignsListFilter.end_date
        )
        if (parsedDateStop) {
          return new Date(parsedDateStop)
        }
        return undefined
      },
      set(value) {
        this.$store.commit('campaigns/SET_CAMPAIGNS_LIST_FILTERS', {
          end_date: `${value.getFullYear()}-${
            value.getMonth() + 1
          }-${value.getDate()}`,
        })
      },
    },
    currentPage: {
      get() {
        return this.campaignsListPagination.current_page
      },
      set(value) {
        this.$store.commit('campaigns/SET_CAMPAIGNS_LIST_PAGINATION', {
          current_page: value,
        })
      },
    },
  },
  async mounted() {
    await this.fetchCampaigns()
    await this.fetchAllFiltersOptions()
  },
  methods: {
    ...mapActions({
      fetchCampaigns: 'campaigns/fetchCampaigns',
      fetchCampaignDeliveryStatuses: 'campaigns/fetchCampaignDeliveryStatuses',
    }),
    /**
     * Change any filter handler
     */
    async handleChangeFilter() {
      this.$store.commit('campaigns/SET_CAMPAIGNS_LIST_PAGINATION', {
        current_page: 1,
      })
      await this.fetchCampaigns()
    },
    /**
     * Change any filter handler
     * @param {string} field field of order
     * @param {string} sortBy sort asc | desc
     */
    async handleSortList({ field, sortBy }) {
      this.$store.commit('campaigns/SET_CAMPAIGNS_LIST_FILTERS', {
        order_by: field,
        sort_by: sortBy,
      })
      await this.fetchCampaigns()
    },
    /**
     * Get all options for filter, dropdown etc.
     */
    async fetchAllFiltersOptions() {
      await this.prepareDeliveryStatusOptions()
    },
    /**
     * Generate delivery status options
     */
    async prepareDeliveryStatusOptions() {
      await this.fetchCampaignDeliveryStatuses()

      this.deliveryStatusOptions = [
        {
          name: 'All',
          status_id: '',
        },
        ...this.campaignDeliveryStatusList,
      ]
    },
  },
}
</script>

<style lang="scss" scoped>
.page-wrapper {
  padding: 0 20px;
}

.page {
  padding: 10px 0 182px;

  &__page-head {
    margin-top: 20px;
    align-items: flex-end;
    justify-content: space-between;
  }

  &__line {
    margin: 30px 0;
    border-top: 1px solid #d7e1ea;
  }

  &__table-pagination {
    margin-top: 24px;
  }
}

.page-head {
  display: flex;

  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }
}

.search-filter {
  margin-top: 30px;

  &__filters {
    display: flex;
    flex: 1;
    margin-top: 12px;
  }

  &__status {
    min-width: 236px;
    margin-right: 6px;
  }

  &__filters-date-range {
    display: flex;
    align-items: center;
    min-width: 236px;
  }

  &__filters-date-range-dash {
    margin: 0 2px;
  }
}
</style>
