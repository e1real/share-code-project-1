<template>
  <div class="radio-buttons-wrapper">
    <div class="radio-buttons">
      <div class="radio-buttons__buttons-wrapper">
        <div
          v-for="(option, index) in options"
          :key="index"
          :class="[
            'radio-buttons__button',
            'radio-button',
            { 'radio-button--active': value === option },
            { 'radio-button--first': index === 0 },
            { 'radio-button--last': index === options.length - 1 },
          ]"
          @click="$emit('click', option)"
        >
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
    value: {
      type: String,
      required: true,
    },
  },
  emits: ['click'],
}
</script>

<style lang="scss" scoped>
.radio-buttons__buttons-wrapper {
  display: flex;
}

.radio-button {
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: 600;
  font-size: 16px;
  line-height: 100%;
  color: #000638;
  min-height: 40px;
  padding: 12px 32px;
  border: 1px solid #d7e1ea;
  border-right: 0;
  cursor: pointer;

  &--active {
    background: #00c2ff;
    color: #fff;
  }

  &--first {
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
  }

  &--last {
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    border-right: 1px solid #d7e1ea;
  }
}
</style>
