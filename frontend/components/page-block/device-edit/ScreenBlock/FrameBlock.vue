<template>
  <div class="frame">
    <h5 class="frame__title">Frame</h5>
    <div class="frame__row">
      <RadioButtonsVar2
        v-model="frameValue"
        class="frame__frame-radio"
        :options="frameOptions"
      />
    </div>
    <div class="frame__row">
      <VInput class="frame__row-xshift" post-fix="px" label="X shift" />
      <VInput class="frame__row-yshift" post-fix="px" label="Y shift" />
    </div>
  </div>
</template>
<script>
import RadioButtonsVar2 from '@/components/form/RadioButtonsVar2'
import VInput from '@/components/form/VInput'

export default {
  components: {
    VInput,
    RadioButtonsVar2,
  },
  data() {
    return {
      frameValue: 'In window',
      frameOptions: ['Full screen', 'In window'],
    }
  },
}
</script>
<style lang="scss" scoped>
.frame {
  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }

  &__frame-radio {
    margin-top: 14px;
  }

  &__row {
    display: flex;
  }

  &__row-xshift {
    margin-right: 6px;
  }

  &__row-xshift,
  &__row-yshift {
    margin-top: 25px;
    max-width: 116px;
  }
}

.layout-resolution-list {
  position: relative;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  grid-column-gap: 30px;
  grid-row-gap: 15px;
  min-height: 40vh;
  margin-top: 30px;
}
</style>
