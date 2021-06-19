<template>
  <div class="checkbox-wrapper">
    <div :class="['checkbox', { 'checkbox--checked': value }]">
      <input
        type="checkbox"
        class="checkbox__input"
        :checked="isChecked"
        :value="value"
        @change="updateInput"
      />
      <div class="checkbox__checkbox">
        <div class="checkbox__checkbox-circle">
          <svg
            class="checkbox__checkbox-check-icon"
            width="10"
            height="9"
            viewBox="0 0 10 9"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M3.50002 8.20994L0.39502 5.10494L1.81002 3.68994L3.50002 5.38494L8.44002 0.439941L9.85502 1.85494L3.50002 8.20994Z"
              fill="white"
            />
          </svg>
        </div>
      </div>
      <div class="checkbox__label">{{ label }}</div>
    </div>
  </div>
</template>
<script>
export default {
  model: {
    prop: 'value',
    event: 'change',
  },
  props: {
    value: {
      type: [Boolean, Number],
      default: false,
    },
    label: {
      type: String,
      default: '',
    },
    trueValue: {
      type: Boolean,
      default: true,
    },
    falseValue: {
      type: Boolean,
      default: false,
    },
  },
  emits: ['change'],
  computed: {
    isChecked() {
      if (this.value instanceof Array) {
        return this.value.includes(this.value)
      }
      // Note that `true-value` and `false-value` are camelCase in the JS
      return this.value === this.trueValue
    },
  },
  methods: {
    updateInput(event) {
      const isChecked = event.target.checked
      if (this.value instanceof Array) {
        const newValue = [...this.value]
        if (isChecked) {
          newValue.push(this.value)
        } else {
          newValue.splice(newValue.indexOf(this.value), 1)
        }
        this.$emit('change', newValue)
      } else {
        this.$emit('change', isChecked ? this.trueValue : this.falseValue)
      }
    },
  },
}
</script>
<style lang="scss" scoped>
.checkbox {
  position: relative;
  display: flex;
  align-items: center;
  padding: 12px 6px 12px 12px;
  height: 40px;
  background: #fff;
  border: 1px solid #d7e1ea;
  box-sizing: border-box;
  border-radius: 8px;

  &__input {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
  }

  &__checkbox-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    border-radius: 4px;
    width: 16px;
    height: 16px;
    border: 1px solid #d7e1ea;
  }
  &__label {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 100%;
    color: #002;
    margin-left: 12px;
  }

  &--checked {
    background: #e6f9ff;
    border: 1px solid #00c2ff;
    border-radius: 8px;

    .checkbox__checkbox-circle {
      border: 0;
      background-color: #00c2ff;
    }
  }
}
</style>
