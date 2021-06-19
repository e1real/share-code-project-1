<template>
  <div class="radio-card-wrapper">
    <div :class="['radio-card', { 'radio-card--active': resolution.active }]">
      <div class="radio-card__left"></div>
      <div class="radio-card__right">
        <h5 class="radio-card__title">{{ resolution.resolution }}</h5>
        <h5 class="radio-card__subtitle">{{ resolution.description }}</h5>
        <VSelectMultiple class="radio-card__select" />
      </div>
      <div class="radio-card__cicle"></div>
    </div>
  </div>
</template>
<script>
import VSelectMultiple from '@/components/form/VSelectMultiple'

export default {
  components: {
    VSelectMultiple,
  },
  props: {
    model: {
      prop: 'value',
      event: 'click',
    },
    resolution: {
      type: Object,
      required: true,
    },
  },
}
</script>
<style lang="scss" scoped>
.radio-card {
  position: relative;
  display: flex;
  background: #fff;
  border: 1px solid #d7e1ea;
  border-radius: 8px;
  padding: 15px 16px 15px 19px;
  width: 330px;
  height: 116px;

  &__left {
    background: #fff;
    border: 1px solid #d7e1ea;
    border-radius: 8px;
    width: 86px;
    height: 86px;
    margin-right: 19px;
  }

  &__right {
    font-family: Inter, sans-serif;
    font-style: normal;
    color: #000638;
    margin-top: 1px;
  }

  &__title {
    font-size: 20px;
    font-weight: 500;
    line-height: 25px;
  }

  &__subtitle {
    font-size: 14px;
    font-weight: 400;
    line-height: 17.5px;
    color: #778699;
  }

  &__select {
    width: 190px;
    height: 32px;
    background-color: #fff;
    border-radius: 8px;
  }

  &__cicle {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    position: absolute;
    right: 10px;
    top: 10px;
    background: #fff;
    border: 1px solid #d7e1ea;
    cursor: pointer;
  }

  &--active {
    background: #e6f9ff;
    border: 1px solid #00c2ff;
    box-sizing: border-box;
    border-radius: 8px;

    .radio-card__cicle {
      border: 5px solid #00c2ff;
    }
  }
}
</style>
