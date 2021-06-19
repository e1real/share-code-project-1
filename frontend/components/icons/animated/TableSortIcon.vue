<template>
  <div class="table-sort-icon-wrapper" @click="handleClickSort">
    <svg
      :class="[
        'table-sort-icon',
        { 'table-sort-icon--asc': orderBy === 'asc' },
        { 'table-sort-icon--desc': orderBy === 'desc' },
      ]"
      width="6"
      height="3"
      viewBox="0 0 6 3"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M5.39961 0.200195H0.599609L2.99961 2.6002L5.39961 0.200195Z"
        fill="#778699"
      />
    </svg>
  </div>
</template>
<script>
export default {
  emits: ['click'],
  data() {
    return {
      orderBy: 'asc',
    }
  },
  methods: {
    /**
     * Sort toggle
     */
    handleClickSort() {
      if (this.orderBy === 'asc') {
        this.orderBy = 'desc'
      } else {
        this.orderBy = 'asc'
      }
      this.$emit('click', this.orderBy)
    },
  },
}
</script>
<style lang="scss" scoped>
.table-sort-icon-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 8px;
  height: 8px;
  background: #d7e1ea;
  border-radius: 2px;
  cursor: pointer;
}

.table-sort-icon--desc {
  transform: rotate(180deg);
}
</style>
