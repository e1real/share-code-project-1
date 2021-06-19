<template>
  <div class="page-wrapper">
    <div class="page">
      <PageBreadcrumbs class="page__breadcrumbs" :items="breadcrumbs" />
      <div class="page__page-head page-head">
        <h4 class="page-head__title">Devices</h4>
        <BaseButton
          class="page-head__button"
          label="Create device"
          @click="$router.push('/inventory/devices/create')"
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
            v-model="filterName"
            placeholder="Placeholder"
            type="search"
            icon="magnify"
            icon-clickable
            @icon-click="handleChangeFilter('name')"
            @keyup.enter.native="handleChangeFilter('name')"
          />
        </div>
        <div class="search-filter__filters">
          <VSelect
            v-model="filterGroup"
            class="search-filter__filters-item search-filter__group"
            :options="filterOptions.screenGroupList"
            empty-option
            empty-option-label="All"
            :searchable="true"
            title-key="name"
            label="Group name"
            @change="handleChangeFilter('group-name')"
          />
          <VSelect
            v-model="filterLocation"
            class="search-filter__filters-item search-filter__location"
            :options="filterOptions.placeList"
            :searchable="true"
            title-key="name"
            label="Location"
            @change="handleChangeFilter('location')"
          />
          <VSelect
            v-model="filterStatus"
            class="search-filter__filters-item search-filter__status"
            :options="filterOptions.statusList"
            label="Status"
            @change="handleChangeFilter('status')"
          />
        </div>
      </div>
      <div class="page__table-wrapper">
        <ScreensTable
          :loading="screenListLoading"
          :items="screenList"
          @sort="handleSortList"
        />
        <b-pagination
          v-model="currentPage"
          class="page__table-pagination"
          :total="screenListPagination.total"
          :range-before="3"
          :range-after="3"
          order="is-centered"
          size="default"
          icon-pack="fa"
          :simple="false"
          :rounded="false"
          :per-page="screenListPagination.per_page"
          aria-next-label="Next page"
          aria-previous-label="Previous page"
          aria-page-label="Page"
          aria-current-label="Current page"
          @change="fetchScreens()"
        >
        </b-pagination>
      </div>
    </div>
    <router-view />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import BaseButton from '@/components/button/BaseButton'
import PageBreadcrumbs from '@/components/breadcrumb/PageBreadcrumbs'
import ScreensTable from '@/components/table/ScreensTable'
import VSelect from '@/components/form/VSelect'

export default {
  components: {
    ScreensTable,
    BaseButton,
    PageBreadcrumbs,
    VSelect,
  },
  data() {
    return {
      breadcrumbs: [
        {
          title: 'Home',
          to: '/',
        },
        {
          title: 'Devices',
          to: '/inventory/devices',
        },
      ],
      autocompleteValue: '',
      filterOptions: {
        screenGroupList: [],
        placeList: [],
        statusList: [
          {
            title: 'All',
            value: '',
          },
          {
            title: 'Online',
            value: 'online',
          },
          {
            title: 'Offline',
            value: 'offline',
          },
        ],
      },
    }
  },
  computed: {
    ...mapGetters({
      screenListLoading: 'screens/screenListLoading',
      screenList: 'screens/screenList',
      screenListPagination: 'screens/screenListPagination',
    }),
    filterName: {
      get() {
        return this.$store.state.screens.screenListFilter.name
      },
      set(value) {
        this.$store.commit('screens/SET_SCREEN_LIST_FILTERS', {
          name: value,
        })
      },
    },
    filterGroup: {
      get() {
        return this.$store.state.screens.screenListFilter.group
      },
      set(value) {
        this.$store.commit('screens/SET_SCREEN_LIST_FILTERS', {
          group: value,
        })
      },
    },
    filterStatus: {
      get() {
        return this.$store.state.screens.screenListFilter.status
      },
      set(value) {
        this.$store.commit('screens/SET_SCREEN_LIST_FILTERS', {
          status: value,
        })
      },
    },
    filterLocation: {
      get() {
        return this.$store.state.screens.screenListFilter.place
      },
      set(value) {
        this.$store.commit('screens/SET_SCREEN_LIST_FILTERS', {
          place: value,
        })
      },
    },
    currentPage: {
      get() {
        return this.screenListPagination.current_page
      },
      set(value) {
        this.$store.commit('screens/SET_SCREEN_LIST_PAGINATION', {
          current_page: value,
        })
      },
    },
  },
  async mounted() {
    await this.fetchScreens()

    const response = await this.$api.get('screen-groups/?per_page=-1')

    const screenGroupList = response.data
    screenGroupList.unshift({
      name: 'All',
      value: '',
    })
    this.filterOptions.screenGroupList = screenGroupList

    const res = await this.$api.get('places/?per_page=-1')
    const placeList = res.data
    placeList.unshift({
      name: 'All',
      value: '',
    })
    this.filterOptions.placeList = placeList
  },
  methods: {
    ...mapActions({
      fetchScreens: 'screens/fetchScreens',
    }),
    /**
     * Change pagination handler
     */
    async handleChangeFilter() {
      this.$store.commit('screens/SET_SCREEN_LIST_PAGINATION', {
        current_page: 1,
      })
      await this.fetchScreens()
    },
    /**
     * Change any filter handler
     */
    async handleSortList({ field, sortBy }) {
      this.$store.commit('screens/SET_SCREEN_LIST_PAGINATION', {
        order_by: field,
        sort_by: sortBy,
      })
      await this.fetchScreens()
    },
    handleChangePagination(ev) {
      window.console.log(ev)
    },
  },
}
</script>

<style lang="scss" scoped>
.page-wrapper {
  padding: 0 30px;
}

.page {
  padding: 10px 0 182px;

  &__page-head {
    margin-top: 20px;
    align-items: flex-end;
    justify-content: space-between;
  }

  &__table-wrapper {
    margin-top: 21px;
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

  &__filters-item {
    &:not(:last-child) {
      margin-right: 12px;
    }
  }

  &__group,
  &__location {
    min-width: 300px;
  }

  &__status {
    min-width: 188px;
  }
}
</style>
