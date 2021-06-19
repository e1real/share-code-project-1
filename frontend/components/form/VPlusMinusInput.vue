<template>
  <div class="v-plus-minus">
    <div class="v-plus-minus__btn v-plus-minus-btn-minus" @click="pmMinus()">
      -
    </div>
    <input
      class="v-plus-minus__value"
      :value="value"
      :min="min"
      :max="max"
      @input="$emit('input', Number($event.target.value))"
    />
    <div class="v-plus-minus__btn v-plus-minus-btn-plus" @click="pmPlus()">
      +
    </div>
  </div>
</template>

<script>
export default {
  model: {
    event: 'input',
    prop: 'value',
  },
  props: {
    value: {
      default: 0,
      type: Number,
    },
    min: {
      default: 0,
      type: Number,
    },
    max: {
      default: undefined,
      type: Number,
    },
  },
  emits: ['input'],
  methods: {
    getNotificationClass(notification) {
      return `alert alert-${notification.type}`
    },
    pmPlus() {
      if (this.value < this.max) {
        this.$emit('input', this.value + 1)
      }
    },
    pmMinus() {
      if (this.value > this.min) {
        this.$emit('input', this.value - 1)
      }
    },
  },
}
</script>
<style lang="scss" scoped>
.v-plus-minus {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  border: 1px solid #d7e1ea;
  box-sizing: border-box;
  border-radius: 8px;
  max-width: 134px;

  &__btn {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 32px;
    height: 36px;
    background: #f4f7fc;
    cursor: pointer;
    user-select: none;
  }

  &__value {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 100%;
    color: #000638;
    text-align: center;
    max-width: 68px;
    border: 0;

    &:focus {
      outline: none;
    }
  }
}

.v-plus-minus-btn-minus {
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
}

.v-plus-minus-btn-plus {
  border-top-right-radius: 8px;
  border-bottom-right-radius: 8px;
}
</style>
