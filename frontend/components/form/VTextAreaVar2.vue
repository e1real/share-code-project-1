<template>
  <div class="v-text-area-var2">
    <div class="v-text-area-var2__top-label">{{ topLabel }}</div>
    <textarea
      :class="[
        'v-text-area-var2__input',
        { 'v-text-area-var2__input--errors': errors.length },
      ]"
      :value="value"
      @input="$emit('input', $event.target.value)"
    ></textarea>
    <div class="v-text-area-var2__errors">{{ errors }}</div>
  </div>
</template>

<script>
export default {
  model: {
    prop: 'value',
    event: 'input',
  },
  props: {
    value: {
      type: String,
      default: '',
    },
    topLabel: {
      type: String,
      default: '',
    },
    errors: {
      type: String,
      default: '',
    },
  },
  emits: ['input'],
}
</script>

<style lang="scss" scoped>
.v-text-area-var2 {
  position: relative;
  display: flex;
  flex-direction: column;
  width: 543px;
  height: 164px;

  &__top-label {
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    line-height: 100%;
    color: #000638;
    margin-bottom: 10px;
  }

  &__input {
    width: 100%;
    height: 100%;
    padding: 4px 8px;
    border-radius: 8px;
    display: flex;
    border: 1px solid #d7e1ea;
    box-sizing: border-box;

    &:focus {
      outline: none;
    }

    &::placeholder {
      font-style: normal;
      font-weight: normal;
      font-size: 16px;
      line-height: 100%;
      color: #778699;
    }

    &--errors {
      border: 1px solid #ef233c;
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
  }
}
</style>
