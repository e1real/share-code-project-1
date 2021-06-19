<template>
  <div class="devices-table-wrapper">
    <Loading v-show="loading" />
    <table class="devices-table">
      <tr class="devices-table__head">
        <th
          v-for="(field, index) in fields"
          :key="index"
          class="devices-table__head-item"
        >
          <div
            :class="[
              'devices-table__head-item-wrapper',
              `devices-table__head-item-${field}`,
            ]"
          >
            <span class="devices-table__head-item-title">
              {{ toTitle(field) }}
            </span>
            <TableSortIcon
              @click="(sortBy) => handleClickSort(field, sortBy)"
            />
          </div>
        </th>
      </tr>
      <tr
        v-for="(item, index) in items"
        :key="index"
        class="devices-table__row"
      >
        <td class="devices-table__row-item">
          <div>
            <b-switch type="is-success" :value="item.active" />
          </div>
        </td>
        <td class="devices-table__row-item">
          <div class="devices-table__row-item-name">
            {{ item.name }}
          </div>
        </td>
        <td class="devices-table__row-item">
          <div>
            {{ item.screen_group ? item.screen_group.name : '' }}
          </div>
        </td>
        <td class="devices-table__row-item">
          <div>{{ item.place ? item.place.name : '' }}</div>
        </td>
        <td class="devices-table__row-item">
          <div class="devices-table__row-item-status">
            <DotStatusBadge :variant="getStatusVariant(item.status)" />
            <span class="devices-table__row-item-status-title">{{
              item.status
            }}</span>
          </div>
        </td>
        <td class="devices-table__row-item">
          <div class="devices-table__row-item-price">
            {{ item.screen_group ? item.screen_group.default_price : '' }} €
          </div>
        </td>
        <td class="devices-table__row-item">
          <div>
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="#D7E1EA"
              xmlns="http://www.w3.org/2000/svg"
              class="devices-table__row-item-edit-icon"
              @click="handleClickEdit(item)"
            >
              <path
                d="M14.06 9L15 9.94L5.92 19H5V18.08L14.06 9ZM17.66 3C17.41 3 17.15 3.1 16.96 3.29L15.13 5.12L18.88 8.87L20.71 7.04C21.1 6.65 21.1 6 20.71 5.63L18.37 3.29C18.17 3.09 17.92 3 17.66 3ZM14.06 6.19L3 17.25V21H6.75L17.81 9.94L14.06 6.19Z"
              />
            </svg>
          </div>
        </td>
      </tr>
    </table>
  </div>
</template>
<script>
import TableSortIcon from '@/components/icons/animated/TableSortIcon'
import DotStatusBadge from '@/components/badge/DotStatusBadge'
import Loading from '@/components/Loading'
import { dateFormatIntl } from '@/utils/date'

export default {
  components: { TableSortIcon, DotStatusBadge, Loading },
  props: {
    loading: {
      type: Boolean,
      default: false,
    },
    items: {
      type: Array,
      default: () => [],
    },
  },
  emits: ['sort'],
  data() {
    return {
      fields: [
        'active',
        'screen_name',
        'group_name',
        'location',
        'status',
        'price',
        'action',
      ],
    }
  },
  methods: {
    dateFormatIntl,
    /**
     * Convert to title
     * @param {String} field
     */
    toTitle(field) {
      return field.replace('_', ' ')
    },
    /**
     * Change sort handler
     */
    handleClickSort(field, sortBy) {
      this.$emit('sort', { field, sortBy })
    },
    /**
     * Click edit button from table row
     * @param {Object} item
     */
    handleClickEdit(item) {
      window.open(`/inventory/devices/edit/${item.screen_id}`)
    },
    getStatusVariant(status) {
      if (status === 'online') {
        return 'green'
      }
      return 'red'
    },
  },
}
</script>
<style lang="scss" scoped>
.devices-table-wrapper {
  position: relative;
  min-height: 40vh;
}
.devices-table {
  width: 100%;
  border-collapse: separate;
  min-height: 240px;

  &__head-item,
  &__row-item {
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    line-height: 100%;
    vertical-align: center !important;
    padding: 19px 0 19px 16px;
  }

  &__head-item {
    font-weight: 500;
    color: #000638;
  }

  &__head-item-wrapper {
    display: flex;
    align-items: center;
  }

  &__head-item-title {
    text-transform: capitalize;
    margin-right: 3px;
  }

  &__head-item-price {
    justify-content: center;
  }

  &__row-item {
    background-color: #fff;
    color: #778699;
  }

  &__row-item-name {
    color: #000638;
  }

  &__row-item-status {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  &__row-item-status-title {
    text-transform: capitalize;
    margin-left: 5px;
  }

  &__row-item-price {
    text-align: center;
  }

  &__head-item-status {
    display: flex;
    justify-content: center;
  }

  &__row-item-edit-icon {
    cursor: pointer;

    &:hover {
      fill: #00c2ff;
    }
  }
}
</style>
