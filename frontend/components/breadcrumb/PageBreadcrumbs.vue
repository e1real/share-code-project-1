<template>
  <ul class="page-breadcrumbs">
    <li
      v-for="(item, index) in items"
      :key="index"
      class="page-breadcrumbs__item breadcrumbs-item"
    >
      <n-link
        :to="item.to"
        active-class="breadcrumbs-item__link breadcrumbs-item-link--active"
        exact-active-class="breadcrumbs-item-link--exact-active"
      >
        {{ item.title }}
      </n-link>
    </li>
  </ul>
</template>
<script>
export default {
  props: {
    items: {
      type: Array,
      default: () => [],
    },
  },
}
</script>
<style lang="scss" scoped>
.page-breadcrumbs {
  display: flex;
}

.breadcrumbs-item {
  &:not(:last-child) ::after {
    content: '/';
    margin: 0 4px;
  }

  &__link {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 11px;
    line-height: 100%;
    color: #778699;
  }
}
</style>
