<template>
  <button
    :class="[
      'base-btn',
      { 'base-btn--primary': variant === 'primary' },
      { 'base-btn--secondary': variant === 'secondary' },
      { 'base-btn--md': size === 'md' },
      { 'base-btn--with-icon': iconExist },
    ]"
    :type="type"
    :disabled="disabled"
    @click="$emit('click')"
  >
    <span class="base-btn__label base-btn-label">{{ label }}</span>
    <slot name="icon" />
  </button>
</template>
<script>
export default {
  props: {
    label: {
      type: String,
      required: true,
    },
    size: {
      type: String,
      default: 'md',
    },
    variant: {
      type: String,
      default: 'primary',
    },
    type: {
      type: String,
      default: 'button',
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  emits: ['click'],
  data() {
    return {
      iconExist: false,
    }
  },
  mounted() {
    this.iconExist = typeof this.$slots.icon === 'object'
  },
}
</script>
<style lang="scss" scoped>
.base-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  border: 0;

  &--primary {
    background-color: #00c2ff;

    .base-btn__label {
      color: #fff;
    }

    &:hover {
      background: #33ceff;
      cursor: pointer;
    }
  }

  &--secondary {
    background-color: #fff;

    .base-btn__label {
      color: #778699;
    }

    &:hover {
      background: #e6e6e6;
    }
  }

  &--md {
    max-width: 190px;
    padding: 12px 16px;
  }

  &--with-icon .base-btn__label {
    margin-right: 10px;
  }

  &:focus {
    outline: none;
  }

  &:hover {
    cursor: pointer;
  }
}

.base-btn-label {
  font-family: 'Inter', sans-serif;
  font-style: normal;
  font-weight: 600;
  font-size: 16px;
  line-height: 100%;
  color: #fff;
}
</style>
