<template>
  <div class="campaigns-table-wrapper">
    <Loading v-show="loading" />
    <table class="campaigns-table">
      <tr class="campaigns-table__head">
        <th
          v-for="(field, index) in fields"
          :key="index"
          class="campaigns-table__head-item"
        >
          <div
            :class="[
              'campaigns-table__head-item-wrapper',
              `campaigns-table__head-item-${field}`,
            ]"
          >
            <span class="campaigns-table__head-item-title">
              {{ toTitle(index) }}
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
        class="campaigns-table__row"
      >
        <td class="campaigns-table__row-item">
          <div>
            <b-switch type="is-success" :value="item.active" />
          </div>
        </td>
        <td class="campaigns-table__row-item">
          <div
            class="campaigns-table__row-item-name"
            @click="$router.push(`/campaigns/edit/${item.campaign_id}`)"
          >
            {{ item.name }}
          </div>
        </td>
        <td class="campaigns-table__row-item">
          <div>{{ item.client_name }}</div>
        </td>
        <td class="campaigns-table__row-item">
          <div>-</div>
        </td>
        <td class="campaigns-table__row-item">
          <div class="campaigns-table__row-item-status">
            <StatusBadge :status="item.delivery_status_name" />
          </div>
        </td>
        <td class="campaigns-table__row-item">
          <div>{{ getCreativesCountTxt(item) }}</div>
        </td>
        <td class="campaigns-table__row-item">
          <div>-</div>
        </td>
        <td class="campaigns-table__row-item">
          <div>
            {{ dateFormatIntl(Date.parse(item.start_date)) }}
          </div>
        </td>
        <td class="campaigns-table__row-item">
          <div>
            {{ dateFormatIntl(Date.parse(item.end_date)) }}
          </div>
        </td>
      </tr>
    </table>
  </div>
</template>
<script>
import TableSortIcon from '~/components/icons/animated/TableSortIcon'
import StatusBadge from '~/components/badge/StatusBadge'
import Loading from '~/components/Loading'
import { dateFormatIntl } from '~/utils/date'

export default {
  components: { TableSortIcon, StatusBadge, Loading },
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
        'is_active',
        'campaign_name',
        'client',
        'account_manager',
        'status',
        'creatives',
        'media',
        'start',
        'end',
      ],
      fieldsTitle: [
        'Active',
        'Campaign name',
        'Client',
        'Account manager',
        'Status',
        'Creatives',
        'Media',
        'Start',
        'End',
      ],
    }
  },
  methods: {
    dateFormatIntl,
    /**
     * Convert to title
     * @param {number} fieldIndex
     */
    toTitle(fieldIndex) {
      return this.fieldsTitle[fieldIndex].replace('_', ' ')
    },
    /**
     * Change sort handler
     */
    handleClickSort(field, sortBy) {
      this.$emit('sort', { field, sortBy })
    },
    /**
     * Get creatives count text
     * @param item {Object} Campaign item
     *
     * @returns {string}
     */
    getCreativesCountTxt(item) {
      if (item.media.length === 1) {
        return `${item.media.length} Creative`
      }
      if (item.media.length > 1) {
        return `${item.media.length} Creatives`
      }
      return ''
    },
  },
}
</script>
<style lang="scss" scoped>
.campaigns-table-wrapper {
  position: relative;
  min-height: 40vh;
}

.campaigns-table {
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
    margin-right: 3px;
  }

  &__row-item {
    background-color: #fff;
    color: #778699;
  }

  &__row-item-name {
    cursor: pointer;
    color: #000638;
  }

  &__row-item-status,
  &__head-item-status {
    display: flex;
    justify-content: center;
  }
}
</style>
