<template>
  <div class="page-wrapper">
    <div class="page">
      <PageBreadcrumbs class="page__breadcrumbs" :items="breadcrumbs" />
      <div class="page__page-head page-head">
        <h4 class="page-head__title">Groups</h4>
        <BaseButton
          class="page-head__button"
          label="Create group"
          @click="$router.push('/inventory/devices-groups/create')"
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
      </div>
      <div class="page__table-wrapper">
        <ScreenGroupsTable
          :loading="screenGroupListLoading"
          :items="screenGroupList"
          @sort="handleSortList"
        />
        <!--        <b-pagination-->
        <!--          v-model="currentPage"-->
        <!--          class="page__table-pagination"-->
        <!--          :total="screenListPagination.total"-->
        <!--          :range-before="3"-->
        <!--          :range-after="3"-->
        <!--          order="is-centered"-->
        <!--          size="default"-->
        <!--          icon-pack="fa"-->
        <!--          :simple="false"-->
        <!--          :rounded="false"-->
        <!--          :per-page="screenListPagination.per_page"-->
        <!--          aria-next-label="Next page"-->
        <!--          aria-previous-label="Previous page"-->
        <!--          aria-page-label="Page"-->
        <!--          aria-current-label="Current page"-->
        <!--          @change="fetchScreens()"-->
        <!--        >-->
        <!--        </b-pagination>-->
      </div>
    </div>
    <router-view />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import BaseButton from '@/components/button/BaseButton'
import PageBreadcrumbs from '@/components/breadcrumb/PageBreadcrumbs'
import ScreenGroupsTable from '@/components/table/ScreenGroupsTable'

export default {
  components: {
    ScreenGroupsTable,
    BaseButton,
    PageBreadcrumbs,
  },
  data() {
    return {
      breadcrumbs: [
        {
          title: 'Home',
          to: '/',
        },
        {
          title: 'Groups',
          to: '/inventory/devices-groups',
        },
      ],
    }
  },
  computed: {
    ...mapGetters({
      screenGroupList: 'screen_groups/screenGroupList',
      screenGroupListLoading: 'screen_groups/screenGroupListLoading',
    }),
    filterName: {
      get() {
        return this.$store.state.screen_groups.name
      },
      set(value) {
        this.$store.commit('screen_groups/SET_SCREEN_GROUPS_LIST_FILTERS', {
          name: value,
        })
      },
    },
  },
  async mounted() {
    await this.fetchScreenGroups()
  },
  methods: {
    ...mapActions({
      fetchScreenGroups: 'screen_groups/fetchScreenGroups',
    }),
    /**
     * Change pagination handler
     */
    async handleChangeFilter() {
      this.$store.commit('screen_groups/SET_SCREEN_GROUPS_LIST_PAGINATION', {
        current_page: 1,
      })
      await this.fetchScreenGroups()
    },
    /**
     * Change any filter handler
     */
    async handleSortList({ field, sortBy }) {
      this.$store.commit('screen_groups/SET_SCREEN_GROUPS_LIST_PAGINATION', {
        order_by: field,
        sort_by: sortBy,
      })
      await this.fetchScreenGroups()
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
