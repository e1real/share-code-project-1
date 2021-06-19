<template>
  <div class="select-wrapper">
    <div class="select-wrapper__top-label input-top-label">{{ label }}</div>
    <div
      v-on-click-outside="close"
      :class="['v-select', { 'v-select--errors': errors }]"
    >
      <span v-if="errors" class="v-select__errors">{{ errors }}</span>
      <span
        v-show="!value"
        class="v-select__placeholder"
        @click="handleClickArrow"
      >
        {{ placeholder }}
      </span>
      <span class="v-select__value" @click="handleClickArrow">
        {{ getTitle(value) }}
      </span>
      <!--span class="v-select__clear" @click="$emit('change', null)"
        ><svg
          width="10"
          height="10"
          viewBox="0 0 10 10"
          fill="#778699"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M9.66634 1.27337L8.72634 0.333374L4.99967 4.06004L1.27301 0.333374L0.333008 1.27337L4.05967 5.00004L0.333008 8.72671L1.27301 9.66671L4.99967 5.94004L8.72634 9.66671L9.66634 8.72671L5.93967 5.00004L9.66634 1.27337Z"
          />
        </svg>
      </span-->
      <svg
        class="v-select__arrow"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        @click="handleClickArrow"
      >
        <path
          d="M4.94 5.72021L8 8.78021L11.06 5.72021L12 6.66688L8 10.6669L4 6.66688L4.94 5.72021Z"
          fill="#778699"
        />
      </svg>
      <div
        v-show="showOptionList"
        :class="[
          'v-select__items-list-wrapper',
          `v-select__items-list-wrapper--${listPosition}`,
        ]"
      >
        <input
          v-show="searchable"
          ref="search-input"
          v-model="searchValue"
          class="list-search-input"
          placeholder="Search..."
        />
        <ul class="v-select__items-list">
          <li
            v-for="(option, index) in filteredOptions"
            :key="index"
            class="v-select__items-list-item"
            @click="handleClickItem(index)"
          >
            {{ getTitle(option) }}
          </li>
          <li v-if="!filteredOptions.length" class="v-select__items-list-item">
            not found
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
import { mixin as onClickOutside } from 'vue-on-click-outside'

export default {
  mixins: [onClickOutside],
  model: {
    prop: 'value',
    event: 'change',
  },
  props: {
    value: {
      type: [String, Object, Array],
      default: () => {},
    },
    options: {
      type: Array,
      default: () => [],
    },
    getTitle: {
      type: Function,
      default(option) {
        if (option && option[this.titleKey]) {
          return option[this.titleKey]
        }
        return ''
      },
    },
    label: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: '',
    },
    searchable: {
      type: Boolean,
      default: false,
    },
    titleKey: {
      type: String,
      default: 'title',
    },
    listPosition: {
      type: String,
      default: 'bottom',
    },
    errors: {
      type: String,
      default: '',
    },
  },
  emits: ['change'],
  data() {
    return {
      showOptionList: false,
      searchValue: '',
    }
  },
  computed: {
    selectTitle: {
      get() {
        const value = this.getTitle(this.value)
        if (value) {
          return value
        }
        return ''
      },
      set(newValue) {
        return this.getTitle(newValue)
      },
    },
    filteredOptions() {
      let options = this.options

      if (this.searchValue) {
        options = options.filter((item) => {
          return this.getTitle(item)
            .toLowerCase()
            .includes(this.searchValue.toLowerCase())
        })
      }
      return options
    },
  },
  mounted() {},
  methods: {
    /**
     * Close option list
     */
    close() {
      this.showOptionList = false
    },
    /**
     * Toggle option list
     */
    toggle() {
      this.showOptionList = !this.showOptionList
    },
    /**
     * Click handler of option
     * @param {number} index index of item
     */
    handleClickItem(index) {
      this.$emit('change', this.filteredOptions[index])
      this.close()
    },
    handleClickArrow() {
      this.toggle()

      if (this.searchable) {
        this.$nextTick(() => this.$refs['search-input'].focus())
      }
    },
  },
}
</script>
<style lang="scss" scoped>
.select-wrapper {
  &__top-label {
    margin-bottom: 11px;
  }
}

.v-select {
  position: relative;
  display: flex;
  align-items: center;
  padding: 0 11px;
  min-width: 186px;
  max-width: 100%;
  height: 38px;
  border: 1px solid #d7e1ea;
  box-sizing: border-box;
  border-radius: 8px;

  &__placeholder {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 100%;
    color: #778699;
    flex-grow: 1;
  }

  &__value {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    line-height: 100%;
    color: #000638;
    flex-grow: 1;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  &__clear {
    cursor: pointer;
    padding: 3px;

    &:hover svg {
      fill: #ef233c;
    }
  }

  &__arrow {
    cursor: pointer;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  &__items-list-wrapper {
    position: absolute;
    width: 100%;
    left: 0;
    z-index: 20;
    background-color: #fff;
    padding: 10px;
    border-radius: 8px;
    -webkit-box-shadow: 10px 10px 31px 0 rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 10px 10px 31px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 10px 10px 31px 0 rgba(0, 0, 0, 0.2);

    &--bottom {
      top: 38px;
    }

    &--top {
      bottom: 38px;
    }
  }

  &__items-list {
    max-height: 116px;
    overflow-y: scroll;
    width: 100%;
    left: 0;
    background-color: #fff;
  }

  &__items-list-item {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    line-height: 100%;
    color: #000638;
    padding: 6px 0;

    &:hover {
      cursor: pointer;
      color: #f26339;
    }
  }

  &__errors {
    font-size: 12px;
    position: absolute;
    color: #ef233c;
    bottom: -20px;
    right: 0;
    z-index: 1;
    white-space: nowrap;
    animation: fade-in 500ms;
    -webkit-animation: fade-in 500ms;
    -moz-animation: fade-in 500ms;
    -o-animation: fade-in 500ms;
    -ms-animation: fade-in 500ms;
  }

  &--errors {
    border: 1px solid #ef233c;
  }
}

.list-search-input {
  font-family: 'Inter', sans-serif;
  font-size: 16px;
  width: 100%;
  margin-top: 6px;
  margin-bottom: 6px;
  border: 0;

  &:focus {
    outline: none;
    margin-bottom: 5px;
    border-bottom: 1px solid #00c2ff;
  }
}

.input-top-label {
  font-family: 'Inter', sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 14px;
  line-height: 100%;
  color: #000638;
}
</style>
