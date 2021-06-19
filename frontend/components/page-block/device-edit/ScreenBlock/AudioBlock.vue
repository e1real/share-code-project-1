<template>
  <div class="audio-block">
    <h5 class="audio-block__title">Audio</h5>
    <p class="audio-block__description">
      Supported video lenght. You can select multiple options.
    </p>
    <div class="audio-block__row-radio">
      <RadioButtonsVar2
        v-model="frameValue"
        class="frame__frame-radio"
        :options="frameOptions"
      />
    </div>
    <h5 class="volume">Volume</h5>
    <VSelectMultiple class="volume__select" />
  </div>
</template>
<script>
import RadioButtonsVar2 from '@/components/form/RadioButtonsVar2'
import VSelectMultiple from '@/components/form/VSelectMultiple'

export default {
  components: {
    VSelectMultiple,
    RadioButtonsVar2,
  },
  data() {
    return {
      frameValue: 'No',
      frameOptions: ['Yes', 'No'],
    }
  },
}
</script>
<style lang="scss" scoped>
.audio-block {
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
  }

  &__row-checkboxes {
    display: flex;
    margin-top: 20px;
  }

  &__checkbox:not(:last-child) {
    margin-right: 10px;
  }
}

.audio-block-list {
  position: relative;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  grid-column-gap: 30px;
  grid-row-gap: 15px;
  min-height: 40vh;
  margin-top: 30px;
}
.frame__frame-radio {
  margin-top: 15px;
}
.volume {
  margin-top: 30px;
  color: #000638;
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 14px;
  line-height: 100%;

  &__select {
    width: 240px;
    height: 38px;
  }
}
</style>
