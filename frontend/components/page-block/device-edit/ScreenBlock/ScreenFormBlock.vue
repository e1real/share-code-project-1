<template>
  <div class="screen-form">
    <h5 class="screen-form__title">Screen</h5>
    <div class="screen-form__row screen-form__row-manufacturer">
      <VInput
        label="Manufacturer"
        class="screen-form__row-manufacturer-input"
      />
      <VInput label="Model" class="screen-form__row-manufacturer-input" />
      <VInput
        label="Serial Number"
        class="screen-form__row-manufacturer-input"
      />
      <VInput label="Screen Size" class="screen-form__row-manufacturer-input" />
    </div>
    <hr class="screen-form__line" />
    <div class="screen-form__row screen-form__row-screen-type">
      <RadioButtons
        v-model="form.screenType"
        class="screen-form__input-screen-type"
        label="Screen type"
        :options="['Indoor', 'Outdoor']"
      />
      <RadioButtons
        v-model="form.touchScreen"
        label="Touch screen"
        :options="['Yes', 'No']"
      />
    </div>
    <div class="screen-form__row screen-form__row-scheduling">
      <RadioButtons
        v-model="form.schebuling"
        label="Scheduling"
        :options="[
          'Switch off after place opening hours automaticaly',
          'Don`t switch off after place opening hours',
        ]"
      />
    </div>
    <hr class="screen-form__line" />
  </div>
</template>
<script>
import VInput from '@/components/form/VInput'
import RadioButtons from '@/components/form/RadioButtons'

export default {
  components: {
    VInput,
    RadioButtons,
  },
  data() {
    return {
      form: {
        screenType: 'Indoor',
        touchScreen: 'Yes',
        schebuling: 'Switch off after place opening hours automaticaly',
        frameButton: 'In window',
      },
    }
  },
}
</script>
<style lang="scss" scoped>
.screen-form {
  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }

  &__row {
    display: flex;
  }

  &__row-manufacturer {
    margin-top: 17px;
  }

  &__row-manufacturer-input:not(:last-child) {
    margin-right: 30px;
  }

  &__row-screen-type {
    margin-top: 56px;
  }

  &__input-screen-type {
    margin-right: 32px;
  }

  &__row-scheduling {
    margin-top: 19px;
  }

  &__line {
    margin: 29px -30px 26px -30px;
    background: #d7e1ea;
    height: 1px;
  }
}
</style>
