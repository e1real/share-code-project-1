<template>
  <div class="autocomplete-tags">
    <div class="autocomplete-tags__top">
      <span class="autocomplete-tags__top-left-column"></span>
      <span class="autocomplete-tags__top-line"></span>
      <div class="autocomplete-tags__top-label-wrapper">
        <p class="autocomplete-tags__top-label">{{ topLabel }}</p>
      </div>
      <span class="autocomplete-tags__top-right-column"></span>
    </div>
    <transition-group
      v-if="items.length"
      name="list"
      tag="div"
      class="autocomplete-tags__bottom"
    >
      <div
        v-for="(item, index) in items"
        :key="item.name + index"
        class="list-item autocomplete-tags__bottom-item"
      >
        <span class="autocomplete-tags__bottom-item-label">
          {{ item.name }}
        </span>
        <svg
          class="autocomplete-tags__bottom-item-remove-icon"
          width="16"
          height="16"
          viewBox="0 0 16 16"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          @click="handleClickRemoveItem(item, index)"
        >
          <path
            d="M12.6663 4.27337L11.7263 3.33337L7.99967 7.06004L4.27301 3.33337L3.33301 4.27337L7.05967 8.00004L3.33301 11.7267L4.27301 12.6667L7.99967 8.94004L11.7263 12.6667L12.6663 11.7267L8.93967 8.00004L12.6663 4.27337Z"
            fill="#778699"
          />
        </svg>
      </div>
    </transition-group>
    <div v-if="!items.length" class="autocomplete-tags__not-found-text">
      {{ notFoundText }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      default: () => [],
    },
    topLabel: {
      type: String,
      default: '',
    },
    notFoundText: {
      type: String,
      default: 'nothing selected',
    },
  },
  emits: ['remove'],
  methods: {
    /**
     * Item remove handler
     * @param {Object} item
     * @param {number} index
     */
    handleClickRemoveItem(item, index) {
      this.$emit('remove', { item, index })
    },
  },
}
</script>
<style lang="scss" scoped>
.autocomplete-tags {
  font-family: 'Inter', sans-serif;
  font-style: normal;

  &__top {
    position: relative;
    display: flex;
    align-items: center;
  }

  &__top-left-column {
    position: absolute;
    left: 0;
    bottom: 6px;
    width: 1px;
    height: 6px;
    background: #d7e1ea;
  }

  &__top-label-wrapper {
    min-width: 58px;
    z-index: 2;
    background-color: #fff;
    margin-left: 14px;
    padding: 6px;
  }

  &__top-label {
    font-weight: normal;
    font-size: 12px;
    line-height: 100%;
    color: #778699;
  }

  &__top-line {
    position: absolute;
    left: 0;
    background-color: #d7e1ea;
    width: 100%;
    height: 1px;
    z-index: 1;
  }

  &__top-right-column {
    position: absolute;
    right: 0;
    bottom: 6px;
    width: 1px;
    height: 6px;
    background: #d7e1ea;
  }

  &__bottom {
    min-height: 28px;
  }

  &__bottom-item {
    display: inline-flex;
    flex-wrap: wrap;
    align-items: center;
    height: 28px;
    background: #f4f7fc;
    border-radius: 8px;
    margin-right: 6px;
    margin-top: 6px;
  }

  &__bottom-item-label {
    max-width: 255px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 500;
    font-size: 14px;
    line-height: 100%;
    color: #000638;
    padding: 6px;
    margin-right: 6px;
  }

  &__bottom-item-remove-icon {
    margin-right: 6px;

    &:hover {
      cursor: pointer;
      background-color: #e8e8e8;
    }
  }

  &__not-found-text {
    font-size: 12px;
  }
}

.list-enter-active,
.list-leave-active {
  transition: all 0.111s;
}
.list-leave-active {
  position: absolute;
  width: 100%;
}
.list-move {
  transition: all 0.111s;
}
.list-enter,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
</style>
