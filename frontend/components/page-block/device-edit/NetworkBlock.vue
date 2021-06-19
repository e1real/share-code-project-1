<template>
  <div class="network-block">
    <h5 class="network-block__title">Network</h5>
    <p class="network-block__description">Select your connection type.</p>
    <div class="network-block__row-network">
      <RadioButtonsVar2 v-model="frameValue" :options="frameOptions" />
    </div>
    <div class="network-block__row-telephone">
      <VInput
        label="Telephone number"
        class="network-block__row-telephone-item"
      />
      <VInput label="Operator" class="network-block__row-telephone-item" />
      <VInput
        label="Internet programm"
        class="network-block__row-telephone-item"
      />
      <VInput
        label="ICCID (SIM card number)"
        class="network-block__row-telephone-item"
      />
    </div>
    <div class="network-block__row-pin-code">
      <VInput
        v-model="form.pinCode"
        class="network-block__pin-code-item"
        native-type="password"
        label="PIN code"
      />
      <VInput
        label="PUK code"
        bottom-placeholder="PUK code contain 8 numbers."
      />
    </div>
    <hr class="network-block__line" />

    <div class="network__row-radio">
      <h5 class="network">IP assigment</h5>
      <RadioButtonsVar2
        v-model="assigmentValue"
        class="frame__frame-radio"
        :options="assigmentOptions"
      />
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
      frameValue: 'LTE',
      frameOptions: ['LAN', 'LTE', 'WI-FI'],
      assigmentValue: 'Static',
      assigmentOptions: ['Static', 'Dynamic'],
      form: {
        pinCode: null,
      },
    }
  },
}
</script>

<style lang="scss" scoped>
.network-block {
  background: #fff;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
  border-radius: 8px;
  padding: 30px;

  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }

  &__description {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 100%;
    color: #778699;
    margin-top: 8px;
    margin-bottom: 15px;
  }

  &__row-telephone {
    display: flex;
    margin-top: 26px;
  }

  &__row-telephone-item:not(:last-child) {
    margin-right: 30px;
  }

  &__row-pin-code {
    display: flex;
    margin-top: 15px;
  }

  &__pin-code-item {
    margin-right: 30px;
  }

  &__line {
    margin: 29px -30px 26px -30px;
    background: #d7e1ea;
    height: 1px;
  }
}
.network {
  color: #000638;
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 14px;
  line-height: 100%;
  margin-bottom: 12px;
}
</style>
