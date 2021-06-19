<template>
  <div class="status-badge-wrapper">
    <div :class="['status-badge', `status-badge--${variant}`]"></div>
  </div>
</template>
<script>
export default {
  props: {
    variant: {
      type: String,
      required: true,
    },
  },
}
</script>
<style lang="scss" scoped>
.status-badge {
  width: 8px;
  height: 8px;
  border-radius: 50%;

  &--green {
    background: #00bc8a;
  }

  &--red {
    background: #ef233c;
  }
}
</style>
