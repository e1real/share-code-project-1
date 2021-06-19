<template>
  <div class="page-wrapper">
    <div class="page">
      <PageBreadcrumbs class="page__breadcrumbs" :items="breadcrumbs" />
      <div class="page__page-head page-head">
        <h4 class="page-head__title">Places</h4>
        <BaseButton
          class="page-head__button"
          label="New place"
          @click="$router.push('/inventory/places/create')"
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
      <div class="page__card-items-wrapper">
        <Loading v-show="placeListLoading" />
        <PlacesCard
          v-for="(place, index) in placeList"
          :key="index"
          :place="place"
          @click="$router.push(`/inventory/places/edit/${place.place_id}`)"
        />
      </div>
      <b-pagination
        v-model="currentPage"
        class="page__card-items-pagination"
        :total="placeListPagination.total"
        :range-before="3"
        :range-after="3"
        order="is-centered"
        size="default"
        icon-pack="fa"
        :simple="false"
        :rounded="false"
        :per-page="placeListPagination.per_page"
        aria-next-label="Next page"
        aria-previous-label="Previous page"
        aria-page-label="Page"
        aria-current-label="Current page"
        @change="fetchPlaces()"
      >
      </b-pagination>
    </div>
    <nuxt-child @create-place="fetchPlaces()"></nuxt-child>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import BaseButton from '~/components/button/BaseButton'
import PageBreadcrumbs from '~/components/breadcrumb/PageBreadcrumbs'
import PlacesCard from '~/components/cards/PlacesCard'
import Loading from '~/components/Loading'

export default {
  components: {
    BaseButton,
    PageBreadcrumbs,
    PlacesCard,
    Loading,
  },
  data() {
    return {
      breadcrumbs: [
        {
          title: 'Home',
          to: '/',
        },
        {
          title: 'Places',
          to: '',
        },
      ],
    }
  },
  computed: {
    ...mapGetters({
      placeListLoading: 'places/placeListLoading',
      placeList: 'places/placeList',
      placeListPagination: 'places/placeListPagination',
    }),
    currentPage: {
      get() {
        return this.placeListPagination.current_page
      },
      set(value) {
        this.$store.commit('places/SET_PLACE_LIST_PAGINATION', {
          current_page: value,
        })
      },
    },
  },
  async mounted() {
    await this.fetchPlaces()
  },
  methods: {
    ...mapActions({
      fetchPlaces: 'places/fetchPlaces',
    }),
    async handleChangeFilter() {
      this.$store.commit('places/SET_PLACES_LIST_PAGINATION', {
        current_page: 1,
      })
      await this.fetchPlaces()
    },
    async handleSortList({ field, sortBy }) {
      this.$store.commit('places/SET_PLACES_LIST_FILTERS', {
        order_by: field,
        sort_by: sortBy,
      })
      await this.fetchPlaces()
    },
  },
}
</script>

<style lang="scss" scoped>
.page-wrapper {
  padding: 0 30px;
  margin: auto;
}

.page {
  padding: 10px 0 182px;

  &__page-head {
    margin-top: 20px;
    align-items: flex-end;
    justify-content: space-between;
  }

  &__table-pagination {
    margin-top: 24px;
  }

  &__card-items-wrapper {
    position: relative;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(255px, 1fr));
    grid-gap: 30px;
    min-height: 40vh;
    margin-top: 30px;
  }

  &__card-items-pagination {
    margin-top: 30px;
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
</style>
