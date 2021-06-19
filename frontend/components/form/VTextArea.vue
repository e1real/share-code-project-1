<template>
  <div class="v-input-wrapper">
    <div class="v-input__top-label">{{ label }}</div>
    <div class="v-input">
      <span class="v-input__text">{{ inlineLabel }}</span>
      <div class="v-input__input-wrapper">
        <textarea
          :type="inputType"
          class="v-input__input"
          :value="value"
          maxlength="300"
          placeholder="max. 300 characters"
          aria-describedby="addon-wrapping"
          @input="$emit('input', $event.target.value)"
        ></textarea>
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
      default: '',
    },
    nativeType: {
      type: String,
      default: 'text',
    },
    inputType: {
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
    border: none;
    border-radius: 8px;
    display: flex;

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
  }

  &__input-wrapper {
    display: flex;
    align-items: center;
    position: relative;
    height: 128px;
    background: #fff;
    border: 1px solid #d7e1ea;
    border-bottom-right-radius: 8px;
    border-bottom-left-radius: 8px;
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
  border-top-right-radius: 8px;
  border-bottom: 0;
  padding: 10px 14px;
  width: 543px;
  height: 38px;
}
</style>
