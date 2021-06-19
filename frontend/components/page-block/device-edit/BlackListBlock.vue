<template>
  <div class="black-list-wrapper">
    <div class="black-list">
      <h5 class="black-list__title">Blacklist</h5>
      <VSelectMultiple
        class="black-list__category"
        label="Blacklist categories"
        searchable
      />
    </div>
  </div>
</template>

<script>
import VSelectMultiple from '@/components/form/VSelectMultiple'

export default {
  components: {
    VSelectMultiple,
  },
}
</script>

<style lang="scss" scoped>
.black-list {
  height: 171px;
  background: #fff;
  border: 1px solid #fff;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
  border-radius: 8px;
  padding: 30px 0 0 30px;

  &__title {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }

  &__category {
    max-width: 499px;
    margin-top: 27.5px;
  }
}
</style>
