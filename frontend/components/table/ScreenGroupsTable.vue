<template>
  <div class="screen_groups-wrapper">
    <Loading v-show="loading" />
    <table class="screen_groups">
      <tr class="screen_groups__head">
        <th
          v-for="(field, index) in fields"
          :key="index"
          class="screen_groups__head-item"
        >
          <div
            :class="[
              'screen_groups__head-item-wrapper',
              `screen_groups__head-item-${field}`,
            ]"
          >
            <span class="screen_groups__head-item-title">
              {{ fieldsTitle[index] }}
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
        class="screen_groups__row"
      >
        <td class="screen_groups__row-item">
          <div
            class="screen_groups__row-item-name"
            @click="handleCLickName(item)"
          >
            {{ item.name }}
          </div>
        </td>
        <td class="screen_groups__row-item">
          <div>{{ item.default_price }}</div>
        </td>
        <td class="screen_groups__row-item">-</td>
        <td class="screen_groups__row-item">{{ item.screens.length }}</td>
      </tr>
    </table>
  </div>
</template>
<script>
import TableSortIcon from '~/components/icons/animated/TableSortIcon'
import Loading from '~/components/Loading'
import { dateFormatIntl } from '~/utils/date'

export default {
  components: { TableSortIcon, Loading },
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
        'name',
        'default_price',
        'default_playlist',
        'Number of devices',
      ],
      fieldsTitle: [
        'Group name',
        'Default price',
        'Default playlist',
        'Number of devices',
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
     * Click item name of table
     * @param item
     */
    handleCLickName(item) {
      window.console.log(item)
    },
  },
}
</script>
<style lang="scss" scoped>
.screen_groups-wrapper {
  position: relative;
  min-height: 40vh;
}

.screen_groups {
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

  &__head-item-name {
    min-width: 30vw;
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
