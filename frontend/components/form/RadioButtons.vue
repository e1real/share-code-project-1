<template>
  <div class="radio-buttons-wrapper">
    <div class="radio-buttons">
      <h5 class="radio-buttons__label">
        {{ label }}
      </h5>
      <div class="radio-buttons__buttons-wrapper">
        <div
          v-for="(option, index) in options"
          :key="index"
          :class="[
            'radio-buttons__button',
            'radio-button',
            { 'radio-button--active': value === option },
          ]"
          @click="$emit('click', option)"
        >
          <span class="radio-button__circle"></span>
          <span class="radio-button__title">{{ option }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  model: {
    prop: 'value',
    event: 'click',
  },
  props: {
    options: {
      type: Array,
      default: () => [],
    },
    label: {
      type: String,
      default: '',
    },
    value: {
      type: String,
      required: true,
    },
  },
}
</script>

<style lang="scss" scoped>
.radio-buttons__buttons-wrapper {
  display: flex;
}

.radio-buttons__button:not(:last-child) {
  margin-right: 6px;
}

.radio-buttons__label {
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 14px;
  line-height: 100%;
  color: #000638;
  margin-bottom: 11px;
}

.radio-button {
  display: flex;
  align-items: center;
  background: #fff;
  border: 1px solid #d7e1ea;
  box-sizing: border-box;
  border-radius: 8px;
  height: 38px;
  padding: 0 16px;
  cursor: pointer;

  &__circle {
    width: 16px;
    height: 16px;
    background: #fff;
    border: 1px solid #d7e1ea;
    box-sizing: border-box;
    border-radius: 50%;
    margin-right: 8px;
  }

  &--active {
    border: 1px solid #00c2ff;
    background-color: #e6f9ff;

    .radio-button__circle {
      border: 4px solid #00c2ff;
    }
  }
}
</style>
