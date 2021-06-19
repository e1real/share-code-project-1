<template>
  <div class="v-input-wrapper">
    <div class="v-input__top-label">{{ label }}</div>
    <div class="v-input">
      <span class="v-input__text">{{ inlineLabel }}</span>
      <div class="v-input__input-wrapper">
        <input
          class="v-input__input"
          :value="value"
          aria-describedby="addon-wrapping"
          @input="$emit('input', $event.target.value)"
        />
      </div>
    </div>
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
    label: {
      type: String,
      required: true,
    },
    inlineLabel: {
      type: String,
      required: true,
    },
    nativeType: {
      type: String,
      default: 'text',
    },
  },
  emits: ['input'],
}
</script>

<style lang="scss" scoped>
.v-input {
  position: relative;
  display: flex;
  flex-direction: row;
  width: 543px;
  height: 38px;

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
    border: none;
    border-radius: 8px;
    display: flex;

    &:focus {
      outline: none;
    }
  }

  &__input-wrapper {
    display: flex;
    align-items: center;
    position: relative;
    height: 38px;
    background: #fff;
    border: 1px solid #d7e1ea;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    width: 100%;
    padding-right: 12px;
  }
}

.v-input__text {
  background: #f4f8fc;
  color: #778699;
  font-size: 16px;
  border: 1px solid #d7e1ea;
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
  border-right: 0;
  padding: 10px 14px;
  width: 83px;
  height: 38px;
}
</style>
