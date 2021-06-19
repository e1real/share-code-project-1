<template>
  <div class="status-badge-wrapper">
    <div :class="['status-badge', classVariant]">
      {{ status }}
    </div>
  </div>
</template>
<script>
const statuses = [
  'Not delivering',
  'Delivering',
  'Delivered',
  'Stopped',
  'In review',
]

export default {
  props: {
    status: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      statuses,
    }
  },
  computed: {
    /**
     * Get dynamic class
     * @return {string}
     */
    classVariant() {
      for (let i = 0; i < statuses.length; i += 1) {
        if (statuses[i] === this.status) {
          return `status-badge--${statuses[i]}`
        }
      }
      return ''
    },
  },
}
</script>
<style lang="scss" scoped>
.status-badge {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 6px;
  width: 127px;
  border-radius: 4px;
  font-family: 'Inter', sans-serif;
  font-size: 14px;
  line-height: 100%;
  text-transform: capitalize;

  &--delivered {
    color: #00c2ff;
    background: #e6f9ff;
  }

  &--delivering {
    color: #faa307;
    background: #fff6e7;
  }

  &--confirmed {
    color: #00bc8a;
    background: #00bc8a;
  }

  &--proposal {
    color: #000638;
    background: #00bc8a;
  }

  &--stopped {
    color: #ef233c;
    background: #fde9eb;
  }
}
</style>
