<template>
  <div class="vdatepicker-wrapper">
    <div
      v-on-click-outside="close"
      :class="['vdatepicker', { 'vdatepicker--errors': errors }]"
    >
      <span
        :class="[
          'vdatepicker__label',
          { 'vdatepicker__label--active': dateFormatIntl(value) },
        ]"
        @click="toggle"
        >{{ dateFormatIntl(value) || label }}</span
      >
      <svg
        class="vdatepicker__icon"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        @click="toggle"
      >
        <path
          d="M4.66667 8.00016H6V9.3335H4.66667V8.00016ZM14 4.00016V13.3335C14 13.6871 13.8595 14.0263 13.6095 14.2763C13.3594 14.5264 13.0203 14.6668 12.6667 14.6668H3.33333C2.59333 14.6668 2 14.0668 2 13.3335V4.00016C2 3.64654 2.14048 3.3074 2.39052 3.05735C2.64057 2.80731 2.97971 2.66683 3.33333 2.66683H4V1.3335H5.33333V2.66683H10.6667V1.3335H12V2.66683H12.6667C13.0203 2.66683 13.3594 2.80731 13.6095 3.05735C13.8595 3.3074 14 3.64654 14 4.00016ZM3.33333 5.3335H12.6667V4.00016H3.33333V5.3335ZM12.6667 13.3335V6.66683H3.33333V13.3335H12.6667ZM10 9.3335V8.00016H11.3333V9.3335H10ZM7.33333 9.3335V8.00016H8.66667V9.3335H7.33333ZM4.66667 10.6668H6V12.0002H4.66667V10.6668ZM10 12.0002V10.6668H11.3333V12.0002H10ZM7.33333 12.0002V10.6668H8.66667V12.0002H7.33333Z"
          fill="#000638"
        />
      </svg>
      <b-datepicker
        v-show="showOptionList"
        class="vdatepicker__content"
        :value="value"
        inline
        :min-date="minDate"
        :max-date="maxDate"
        @input="handleChangeDate"
      />
      <span class="vdatepicker__errors">{{ errors }}</span>
    </div>
  </div>
</template>
<script>
import { mixin as onClickOutside } from 'vue-on-click-outside'
import { dateFormatIntl } from '@/utils/date'

export default {
  mixins: [onClickOutside],
  model: {
    prop: 'value',
    event: 'change',
  },
  props: {
    value: {
      type: [Date, Array],
      default: undefined,
    },
    options: {
      type: Array,
      default: () => [],
    },
    getTitle: {
      type: Function,
      default: (option) => {
        if (option && option.title) {
          return option.title
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
    minDate: {
      type: Date,
      default: undefined,
    },
    maxDate: {
      type: Date,
      default: undefined,
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
      selectedItemIdx: -1,
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
  },
  methods: {
    dateFormatIntl,
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
     * Click handler of datepicker
     * @param {Date} date changed date
     */
    handleChangeDate(date) {
      this.$emit('change', date)
      this.close()
    },
  },
}
</script>
<style lang="scss" scoped>
.vdatepicker {
  position: relative;
  display: flex;
  align-items: center;
  padding: 0 11px;
  min-width: 226px;
  height: 38px;
  border: 1px solid #d7e1ea;
  box-sizing: border-box;
  border-radius: 8px;

  &__label {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 100%;
    color: #778699;
    flex-grow: 1;

    &--active {
      color: #000638;
    }
  }

  &__icon {
    margin-left: 6px;
    cursor: pointer;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  &__content {
    position: absolute;
    z-index: 20;
    top: 38px;
    left: 0;
  }

  &__errors {
    font-size: 12px;
    white-space: nowrap;
    position: absolute;
    color: #ef233c;
    bottom: -20px;
    z-index: 1;
  }

  &--errors {
    border: 1px solid #ef233c;
  }
}
</style>
